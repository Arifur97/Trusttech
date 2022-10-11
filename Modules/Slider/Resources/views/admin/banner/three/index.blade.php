@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', 'Banner')

    <li class="active">Banner</li>
@endcomponent

@section('content')
<div class="row">
    <div class="col-md-8">
        <a href="{{ route('admin.banners.twocol.index') }}" class="btn btn-info">Two Column</a>
        <a href="{{ route('admin.banners.threecol.index') }}" class="btn btn-info">Three Column</a>
        <a href="{{ route('admin.banners.fourcol.index') }}" class="btn btn-info">Four Column</a>
    </div>
    <div class="col-md-4" style="text-align: end;">
        <a href="#" type="button" class="btn btn-primary" data-toggle="modal" data-target="#threeColBannerModal">Create</a>
    </div>
</div>
<div style="margin-bottom: 25px;"></div>
<div class="panel">
    <div class="panel-body">
        <div class="row" style="margin-left: 10px;">
            @if($bannersEnable->banner_three_col == '0') 
                <a href="{{ url('admin/banners/three_col/enable/1') }}" class="btn btn-success">Enable Banner</a>
            @else
                <a href="{{ url('admin/banners/three_col/enable/0') }}" class="btn btn-danger">Disable Banner</a>
            @endif
        </div>
    </div>
</div>
<div style="margin-bottom: 15px;"></div>
<div class="panel">
    <div class="panel-body">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Image</th>
                    <th scope="col">Url</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @foreach ($banners as $banner)
                    <tr>
                        <th scope="row">{{ $i++ }}</th>
                        <td>
                            <img src="{{ URL::to($banner->image) }}" alt="" class="img-fluid banner-img">
                        </td>
                        <td>{{ $banner->url }}</td>
                        <td>
                            <a href="#" data-toggle="modal" data-target="#threeColBannerModal-{{ $banner->id }}" class="btn btn-warning">Edit</a>
                            <a href="{{ route('admin.banners.threecol.destroy', ['id' => $banner->id]) }}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@foreach ($banners as $banner)

<div class="modal fade" id="threeColBannerModal-{{ $banner->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Create Banner</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('admin.banners.threecol.update', ['id' => $banner->id]) }}" class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="panel">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <img src="{{ URL::to($banner->image) }}" alt="" class="img-fluid banner-img">
                                </div>
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" name="image" value="" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Url Link</label>
                                    <input type="text" name="url" value="" class="form-control" placeholder="URL Link">
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="Save">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>
@endforeach


<div class="modal fade" id="threeColBannerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Create Banner</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('admin.banners.threecol.store') }}" class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="panel">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" name="image" value="" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Url Link</label>
                                    <input type="text" name="url" value="" class="form-control" placeholder="URL Link">
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="Save">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>
@endsection

