<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

<script src="{{ asset('js/app.js') }}" defer></script>


    <title>Document</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light container-fluid">
        <div class="container-fluid">
          <a class="navbar-brand" href="{{ route('ManagershowPost') }}">All Posts</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route('ManagerCreatePost') }}">Create Post</a>
              </li>

            </ul>
          </div>
        </div>
        <div class="">
            <div class="collapse navbar-collapse mr-3" id="navbarNav">
              <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>


              </ul>
            </div>
          </div>
      </nav>

<!-- On tables -->
<div class="container">

    <table class="table-primary table-bordered text-nowrap mx-auto mt-5">
        <thead >
            <tr >

                <th class="p-3">SL No.</th>
                <th class="p-3">Title</th>
                <th class="p-3">Description</th>
                <th class="p-3">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                @php $i = 0; @endphp

                @forelse ($userData as $data)

                @php $i++; @endphp

                <td class="p-3">{{ $i }}</td>
                <td class="p-3">{{ $data->title }}</td>
                <td class="p-3">{{ $data->description }}</td>
                <td class="p-3">
                    @can('isAdmin')

                    <form action="{{ route('ManagerdestroyPost',$data->id) }}">
                        @csrf
                        @method('DELETE')
                        <a href="{{ route('ManagereditPost',$data->id) }}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                        <button type="submit" class="btn btn-sm btn-danger"> <i class="fas fa-trash-alt"></i></button>
                    </form>

                    @endcan

                </td>

            </tr>

            @empty

            @endforelse

        </tbody>

        <tfoot>

        </tfoot>

    </table>
</div>

</body>
</html>
