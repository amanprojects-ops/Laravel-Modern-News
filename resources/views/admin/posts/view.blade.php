@include('admin.inc.header')

<div class="container-fluid">
    <div class="row column_title">
        <div class="col-md-12">
            <div class="page_title">
                <h2>View Article</h2>
            </div>
        </div>
    </div>
    <div class="row column4 graph">
        <div class="white_shd full margin_bottom_30">
            <div class="col-md-12">
                <div class="white_shd full margin_bottom_30">
                    <div class="full graph_head">
                        <div class="heading1 margin_0">
                            <h2>
                                <a href="{{ route('admin.posts.create') }}" class="btn cur-p btn-primary">
                                    <i class="fa fa-plus"></i>
                                    New
                                </a>
                            </h2>
                        </div>
                    </div>
                    <div class="table_section padding_infor_info">
                        <div class="table-responsive-sm">
                            <table class="table table-hover" id="dataTables">
                                <thead>
                                    <tr>
                                        <th>SL No.</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Writer</th>
                                        <th>Status</th>
                                        <th>Updated At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($posts->isEmpty())
                                        <tr>
                                            <td colspan="6" class="text-center">No posts found</td>
                                        </tr>
                                    @else
                                        @foreach ($posts as $post)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ ucwords($post->title) }}</td>
                                                <td>{{ ucwords($post->category_name) }}</td>
                                                <td>{{ ucwords($post->writer_name) }}</td>
                                                <td>
                                                    <form action="{{ route('admin.posts.status.update', $post->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('PATCH')
                                                        @if ($post->status == 1)
                                                            <button type="submit" name="status" value="2"
                                                                class="badge badge-success cursor-pointer"
                                                                title="Click to set as Rejected"
                                                                onclick="return confirm('Are you sure you want to change the status to Rejected?');">Published</button>
                                                        @elseif($post->status == 0)
                                                            <button type="submit" name="status" value="1"
                                                                class="badge badge-warning cursor-pointer"
                                                                title="Click to Publish"
                                                                onclick="return confirm('Are you sure you want to change the status to Published?');">Draft</button>
                                                        @else
                                                            <button type="submit" name="status" value="1"
                                                                class="badge badge-danger cursor-pointer"
                                                                title="Click to Publish"
                                                                onclick="return confirm('Are you sure you want to change the status to Published?');">Rejected</button>
                                                        @endif
                                                    </form>
                                                </td>
                                                <td>{{ date('d M Y h:i A', strtotime($post->updated_at)) }}</td>
                                                <td>
                                                    <a target="_blank"
                                                        href="{{ route('admin.posts.temp-post', $post->id) }}"
                                                        class="btn btn-info"><i class="fa fa-eye"></i></a>
                                                    <a href="{{ route('admin.posts.edit', $post->id) }}"
                                                        onclick="return confirm('Are you sure you want to edit this post?');"
                                                        class="btn btn-warning"><i class="fa fa-pencil"></i></a>
                                                    <form action="{{ route('admin.posts.destroy', $post->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"
                                                            onclick="return confirm('Are you sure you want to delete this post?');">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@include('admin.inc.footer')
