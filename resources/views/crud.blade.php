<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    
    {{-- sweet alert --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Axios --}}
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <title>Document</title>

</head>
<body style="padding-left: 30px; padding-top: 100px">

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form action="/send" method="POST">
                    @csrf
                    <input type="text" name="id" id="id" hidden>
                    <div>
                        <label for="Nama">Nama</label>
                        <input type="text" class="form-control" name="nama" id="nama">
                    </div>
                    <div>
                        <label for="jk">Jenis Kelamin</label>
                        <input type="text" class="form-control" name="jk" id="jk">
                    </div>
                    <div>
                        <label for="parrentId">ParrentId</label>
                        <input type="text" class="form-control" name="parrentId" id="parrentId">
                    </div>
                    <div style="padding-top: 30px; justify-content: right">
                        <input class="btn btn-success" type="submit"></input>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>
    {{-- end modal --}}


    <table class="table">
        <thead class="text-info">
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>ParrentId</th>
            <th><button class="btn button-primary" id="add">Tambah Data</button></th>
        </thead><tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $item['nama'] }}</td>
                    <td>{{ $item['jk'] }}</td>
                    <td>{{ $item['parrentId'] }}</td>
                    <td>
                        <div>
                            <button class="btn btn-warning" id="edit" data-id="{{ $item['id'] }}" data-name="{{ $item['nama'] }}" data-jk="{{ $item['jk'] }}"
                            data-parrent="{{ $item['parrentId'] }}">Edit</button>
                            <button class="btn btn-danger" data-id="{{ $item['id'] }}" id="del">Delete</button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <script>

        $(document).on('click', '#add', function(){
            $('#exampleModalCenter').modal('show');
        })


        $(document).on('click', '#edit', function(){
            $('#exampleModalCenter').modal('show');
            const id = $(this).data('id');
            const nama = $(this).data('name');
            const jk = $(this).data('jk');
            const parrentId = $(this).data('parrent');
            $(".modal-body #id").val(id);
            $(".modal-body #nama").val(nama);
            $(".modal-body #jk").val(jk);
            $(".modal-body #parrentId").val(parrentId);
        })

        $(document).on('click', '#del', function(){
            const id = $(this).data('id');
            
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    axios.post('/del', {
                    id
                }).then((response) => {
                    Swal.fire({
                        title: 'Success...',
                        text: 'Sukses Menghapus  Data!',
                        type: 'success',
                        confirmButtonText: 'Ok',
                    }).then((result) => {
                        location.reload();
                    })
                }).catch((error) => {
                    Swal.fire({
                        title: 'Oops...',
                        text: 'Ada yang salah',
                        type: 'error',
                        confirmButtonText: 'Ok'
                    })
                })
                })
        })
    </script>
</body>
</html>