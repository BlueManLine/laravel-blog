<ul class="nav nav-sidebar">
    <li class="{{ Helpers\MrView::activeLaravelLink('Admin\IndexController@getIndex', 'active') }}"><a href="{{ URL::to('admin/') }}">Dashboard</a></li>
</ul>

<span class="glyphicon glyphicon-edit"></span> Posts
<ul class="nav nav-sidebar">
    <li class="{{ Helpers\MrView::activeLaravelLink('Admin\PostsController@*Create', 'active') }}"><a href="{{ URL::to('admin/posts/create') }}">Add new</a></li>
    <li class="{{ Helpers\MrView::activeLaravelLink('Admin\PostsController@*Index', 'active') }}"><a href="{{ URL::to('admin/posts') }}">List</a></li>
</ul>

<span class="glyphicon glyphicon-user"></span> Users
<ul class="nav nav-sidebar">
    <li><a href="#">Add new</a></li>
    <li class="{{ Helpers\MrView::activeLaravelLink('Admin\UsersController@*Index', 'active') }}"><a href="{{ URL::to('admin/users') }}">List</a></li>
    <li class="{{ Helpers\MrView::activeLaravelLink('Admin\CommentsController@*Index', 'active') }}"><a href="{{ URL::to('admin/comments') }}">Comments</a></li>
</ul>
