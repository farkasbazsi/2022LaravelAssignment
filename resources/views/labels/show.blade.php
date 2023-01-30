@extends('layouts.app')
@section('title', $label->name . ' items')

@section('content')
<div class="container">
    <div class="row justify-content-between">
        <div class="col-12 col-md-8">
            <h1>Items for <span class="badge bg-primary">{{$label->name}}</span></h1>
        </div>
        <div class="col-12 col-md-4">
            <div class="float-lg-end">
                {{-- TODO: Links, policy --}}

                <a href="{{ route('labels.edit', $label) }}" role="button" class="btn btn-sm btn-primary">
                    <i class="far fa-edit"></i> Edit label
                </a>

                <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete-confirm-modal">
                    <i class="far fa-trash-alt"></i> Delete category
                </button>

            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="delete-confirm-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Confirm delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- TODO: name --}}
                    Are you sure you want to delete category <strong>N/A</strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button
                        type="button"
                        class="btn btn-danger"
                        onclick="document.getElementById('delete-category-form').submit();"
                    >
                        Yes, delete this category
                    </button>

                    {{-- TODO: Route, directives --}}
                    <form id="delete-category-form" action="#" method="POST" class="d-none">

                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- TODO: Session flashes --}}

    <div class="row mt-3">
        <div class="col-12 col-lg-9">
            <div class="row">
                {{-- TODO: Read posts from DB --}}

                @forelse ($items as $item)
                <div class="col-12 col-md-6 col-lg-4 mb-3 d-flex align-self-stretch">
                    <div class="card w-100">
                        <img
                            src="{{
                                asset(
                                    $item->image
                                    ? 'storage/' . $item->image
                                    : 'images/default_post_cover.png'
                                )
                            }}"
                            width="350px"
                            height="175px"
                            class="card-img-top"
                            alt="Post cover"
                        >
                        <div class="card-body">
                            {{-- TODO: Title --}}
                            <h5 class="card-title mb-0">{{$item->name}}</h5>
                            {{-- TODO: Short desc --}}
                            <p class="card-text mt-1">{{substr($item->description, 0, 90);}}...</p>
                        </div>
                        <div class="card-footer">
                            {{-- TODO: Link --}}
                            <a href="{{ route('items.show',$item) }}" class="btn btn-primary">
                                <span>View post</span> <i class="fas fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-warning" role="alert">
                        No posts found!
                    </div>
                </div>
                @endforelse
            </div>

            <div class="d-flex justify-content-center">
                {{-- TODO: Pagination --}}
            </div>

        </div>
        @can('viewAny', App\Models\Label::class)
            <div class="col-12 col-lg-3">
                <div class="row">
                    <div class="col-12 mb-3">
                        <div class="card bg-light">
                            <div class="card-header">
                                Labels
                            </div>
                            <div class="card-body">
                                {{-- TODO: Read categories from DB --}}
                                @foreach ($labels as $label)
                                        <a href="{{ route('labels.show', $label) }}" class="text-decoration-none">
                                            <span class="badge bg-secondary text-white me-1">{{ $label->name }}</span>
                                        </a>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{--<div class="col-12 mb-3">
                        <div class="card bg-light">
                            <div class="card-header">
                                Statistics
                            </div>
                            <div class="card-body">
                                <div class="small">
                                    <ul class="fa-ul">
                                        {{-- TODO: Read stats from DB
                                        <li><span class="fa-li"><i class="fas fa-user"></i></span>Users: N/A</li>
                                        <li><span class="fa-li"><i class="fas fa-layer-group"></i></span>Categories: N/A</li>
                                        <li><span class="fa-li"><i class="fas fa-file-alt"></i></span>Posts: N/A</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>--}}
                </div>
            </div>
        @endcan
    </div>
</div>
@endsection
