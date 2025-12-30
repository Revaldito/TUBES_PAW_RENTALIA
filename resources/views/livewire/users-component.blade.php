@section('title', 'Admin Rentalia')
<div class="container-fluid pt-4 px-4">   
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
             <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Data User</h6>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Role</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user as $data)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->email }}</td>
                                        <td>{{ $data->role }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                    </div>
                    
                </div>