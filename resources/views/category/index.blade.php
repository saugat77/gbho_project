@extends('layouts.admin')

@section('content')
<div>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Categories</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Categories</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    @include('alerts.all')
    <div class="row">
        <div class="col-md-4">
            <x-category-form :category="$category"/>
        </div>
        <div class="col-md-8">
            <div class="card z-depth-0">
                <div class="card-body">
                    <table class="table table-hover table-responsive-sm">
                        <tr class="text-uppercase font-poppins">
                            {{-- <th>Thumbnail</th> --}}
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Parent</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                        <tbody>
                            @forelse($categories as $firstLevelCategory)
                            @include('category.table-row', ['category'=> $firstLevelCategory,'level' => 1])

                            {{-- Second level --}}
                            @foreach($firstLevelCategory->childCategories as $secondLevelCategory)
                            @include('category.table-row', ['category'=> $secondLevelCategory, 'level' => 2, 'parentCategoryName' => $firstLevelCategory->name])
                            
                            {{-- Third level --}}
                            @foreach($secondLevelCategory->childCategories as $thirdLevelCategory)
                            @include('category.table-row', ['category'=> $thirdLevelCategory, 'level' => 3, 'parentCategoryName' => $secondLevelCategory->name])
                            @endforeach
                            
                            @endforeach
                            @empty
                            <tr>
                                <td colspan="42" class="font-italic text-center">No Record Found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
