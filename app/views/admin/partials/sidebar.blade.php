<ul class="nav nav-sidebar">
    <li class="{{ Helpers\MrView::activeLaravelLink('Admin\IndexController@getIndex', 'active') }}"><a href="{{ URL::to('admin/') }}">Dashboard</a></li>
</ul>

<span class="glyphicon glyphicon-edit"></span> Posts
<ul class="nav nav-sidebar">
    <li class="{{ Helpers\MrView::activeLaravelLink('Admin\PostsController@*Create', 'active') }}"><a href="{{ URL::to('admin/posts/create') }}">Add new</a></li>
    <li><a href="#">List</a></li>
    <li><a href="#">Tags</a></li>
</ul>

<span class="glyphicon glyphicon-user"></span> Users
<ul class="nav nav-sidebar">
    <li><a href="">Add new</a></li>
    <li><a href="">List</a></li>
    <li><a href="#">Comments</a></li>
</ul>