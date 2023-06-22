@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.book.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.books.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.book.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $book->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.book.fields.title') }}
                                    </th>
                                    <td>
                                        {{ $book->title }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.book.fields.author') }}
                                    </th>
                                    <td>
                                        {{ $book->author }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.book.fields.edition') }}
                                    </th>
                                    <td>
                                        {{ $book->edition }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.book.fields.publisher') }}
                                    </th>
                                    <td>
                                        {{ $book->publisher }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.book.fields.isbn') }}
                                    </th>
                                    <td>
                                        {{ $book->isbn }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.book.fields.copies') }}
                                    </th>
                                    <td>
                                        {{ $book->copies }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.book.fields.price') }}
                                    </th>
                                    <td>
                                        {{ $book->price }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.book.fields.data') }}
                                    </th>
                                    <td>
                                        {{ $book->data }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.book.fields.subject') }}
                                    </th>
                                    <td>
                                        {{ $book->subject->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.book.fields.added_by') }}
                                    </th>
                                    <td>
                                        {{ $book->added_by->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.book.fields.cover') }}
                                    </th>
                                    <td>
                                        @if($book->cover)
                                            <a href="{{ $book->cover->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $book->cover->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.books.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection