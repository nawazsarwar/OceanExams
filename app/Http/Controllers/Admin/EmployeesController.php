<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyEmployeeRequest;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\EmployeeType;
use App\Models\Institute;
use App\Models\Subject;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class EmployeesController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('employee_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Employee::with(['subjects', 'designation', 'employee_type', 'institution'])->select(sprintf('%s.*', (new Employee)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'employee_show';
                $editGate      = 'employee_edit';
                $deleteGate    = 'employee_delete';
                $crudRoutePart = 'employees';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('contact', function ($row) {
                return $row->contact ? $row->contact : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });

            $table->editColumn('gender', function ($row) {
                return $row->gender ? Employee::GENDER_SELECT[$row->gender] : '';
            });
            $table->editColumn('photo', function ($row) {
                if ($photo = $row->photo) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });
            $table->editColumn('signature', function ($row) {
                if ($photo = $row->signature) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });
            $table->editColumn('subjects', function ($row) {
                $labels = [];
                foreach ($row->subjects as $subject) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $subject->name);
                }

                return implode(' ', $labels);
            });
            $table->addColumn('designation_name', function ($row) {
                return $row->designation ? $row->designation->name : '';
            });

            $table->addColumn('employee_type_title', function ($row) {
                return $row->employee_type ? $row->employee_type->title : '';
            });

            $table->addColumn('institution_name', function ($row) {
                return $row->institution ? $row->institution->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'photo', 'signature', 'subjects', 'designation', 'employee_type', 'institution']);

            return $table->make(true);
        }

        return view('admin.employees.index');
    }

    public function create()
    {
        abort_if(Gate::denies('employee_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subjects = Subject::pluck('name', 'id');

        $designations = Designation::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $employee_types = EmployeeType::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $institutions = Institute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.employees.create', compact('designations', 'employee_types', 'institutions', 'subjects'));
    }

    public function store(StoreEmployeeRequest $request)
    {
        $employee = Employee::create($request->all());
        $employee->subjects()->sync($request->input('subjects', []));
        if ($request->input('photo', false)) {
            $employee->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($request->input('signature', false)) {
            $employee->addMedia(storage_path('tmp/uploads/' . basename($request->input('signature'))))->toMediaCollection('signature');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $employee->id]);
        }

        return redirect()->route('admin.employees.index');
    }

    public function edit(Employee $employee)
    {
        abort_if(Gate::denies('employee_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subjects = Subject::pluck('name', 'id');

        $designations = Designation::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $employee_types = EmployeeType::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $institutions = Institute::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $employee->load('subjects', 'designation', 'employee_type', 'institution');

        return view('admin.employees.edit', compact('designations', 'employee', 'employee_types', 'institutions', 'subjects'));
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $employee->update($request->all());
        $employee->subjects()->sync($request->input('subjects', []));
        if ($request->input('photo', false)) {
            if (! $employee->photo || $request->input('photo') !== $employee->photo->file_name) {
                if ($employee->photo) {
                    $employee->photo->delete();
                }
                $employee->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($employee->photo) {
            $employee->photo->delete();
        }

        if ($request->input('signature', false)) {
            if (! $employee->signature || $request->input('signature') !== $employee->signature->file_name) {
                if ($employee->signature) {
                    $employee->signature->delete();
                }
                $employee->addMedia(storage_path('tmp/uploads/' . basename($request->input('signature'))))->toMediaCollection('signature');
            }
        } elseif ($employee->signature) {
            $employee->signature->delete();
        }

        return redirect()->route('admin.employees.index');
    }

    public function show(Employee $employee)
    {
        abort_if(Gate::denies('employee_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employee->load('subjects', 'designation', 'employee_type', 'institution');

        return view('admin.employees.show', compact('employee'));
    }

    public function destroy(Employee $employee)
    {
        abort_if(Gate::denies('employee_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employee->delete();

        return back();
    }

    public function massDestroy(MassDestroyEmployeeRequest $request)
    {
        $employees = Employee::find(request('ids'));

        foreach ($employees as $employee) {
            $employee->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('employee_create') && Gate::denies('employee_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Employee();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
