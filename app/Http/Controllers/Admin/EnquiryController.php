<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEnquiryRequest;
use App\Http\Requests\StoreEnquiryRequest;
use App\Http\Requests\UpdateEnquiryRequest;
use App\Models\Course;
use App\Models\Enquiry;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class EnquiryController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('enquiry_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Enquiry::with(['course'])->select(sprintf('%s.*', (new Enquiry)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'enquiry_show';
                $editGate      = 'enquiry_edit';
                $deleteGate    = 'enquiry_delete';
                $crudRoutePart = 'enquiries';

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
            $table->editColumn('first_name', function ($row) {
                return $row->first_name ? $row->first_name : '';
            });
            $table->editColumn('middle_name', function ($row) {
                return $row->middle_name ? $row->middle_name : '';
            });
            $table->editColumn('last_name', function ($row) {
                return $row->last_name ? $row->last_name : '';
            });
            $table->editColumn('fathers_name', function ($row) {
                return $row->fathers_name ? $row->fathers_name : '';
            });
            $table->editColumn('mothers_name', function ($row) {
                return $row->mothers_name ? $row->mothers_name : '';
            });
            $table->editColumn('mobile_no', function ($row) {
                return $row->mobile_no ? $row->mobile_no : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->addColumn('course_title', function ($row) {
                return $row->course ? $row->course->title : '';
            });

            $table->editColumn('class', function ($row) {
                return $row->class ? Enquiry::CLASS_SELECT[$row->class] : '';
            });
            $table->editColumn('passing_year', function ($row) {
                return $row->passing_year ? $row->passing_year : '';
            });
            $table->editColumn('message', function ($row) {
                return $row->message ? $row->message : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'course']);

            return $table->make(true);
        }

        return view('admin.enquiries.index');
    }

    public function create()
    {
        abort_if(Gate::denies('enquiry_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courses = Course::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.enquiries.create', compact('courses'));
    }

    public function store(StoreEnquiryRequest $request)
    {
        $enquiry = Enquiry::create($request->all());

        return redirect()->route('admin.enquiries.index');
    }

    public function edit(Enquiry $enquiry)
    {
        abort_if(Gate::denies('enquiry_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courses = Course::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $enquiry->load('course');

        return view('admin.enquiries.edit', compact('courses', 'enquiry'));
    }

    public function update(UpdateEnquiryRequest $request, Enquiry $enquiry)
    {
        $enquiry->update($request->all());

        return redirect()->route('admin.enquiries.index');
    }

    public function show(Enquiry $enquiry)
    {
        abort_if(Gate::denies('enquiry_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $enquiry->load('course');

        return view('admin.enquiries.show', compact('enquiry'));
    }

    public function destroy(Enquiry $enquiry)
    {
        abort_if(Gate::denies('enquiry_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $enquiry->delete();

        return back();
    }

    public function massDestroy(MassDestroyEnquiryRequest $request)
    {
        $enquiries = Enquiry::find(request('ids'));

        foreach ($enquiries as $enquiry) {
            $enquiry->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
