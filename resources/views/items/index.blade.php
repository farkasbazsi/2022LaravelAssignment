@extends('layouts.app')
@section('title', 'Items')

@section('content')
<div class="container">
    <div class="row justify-content-between">
        <div class="col-12 col-md-8">
            <h1>All items in the musem</h1>
        </div>
            <div class="col-12 col-md-4">
                <div class="float-lg-end">
                    {{-- TODO: Links, policy --}}
                    @can('create', App\Models\Item::class)
                    <a href="{{ route('items.create') }}" role="button" class="btn btn-sm btn-success mb-1"><i class="fas fa-plus-circle"></i> Create item</a>
                    @endcan
                    @can('create', App\Models\Label::class)
                    <a href="{{ route('labels.create') }}" role="button" class="btn btn-sm btn-success mb-1"><i class="fas fa-plus-circle"></i> Create label</a>
                    @endcan
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
                {{ $items->links() }}
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
