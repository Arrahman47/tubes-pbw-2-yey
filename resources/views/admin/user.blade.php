@include('../template/header');
@include('../template/sidebar');
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?=$title?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">{{$title}}</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-users mr-1"></i>
                  Home
              </h3>
            <div class="card-tools">
              <ul class="nav nav-pills ml-auto">
                <li class="nav-item">
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    <i class="fas fa-plus"></i>
                  </button>
                </li>
              </ul>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Full Name</th>
                <th>User Name</th>
                <th>Edit</th>
                <th>DELETE</th>
              </tr>
            </thead>
            <tbody>
            <?php $i = 1;?>
                @foreach ($data as $d)
                  <tr>
                    <td>{{ $d->fullname }}</td>
                    <td>{{ $d->username }}</td>
                    <td align="center"><button type="button" class="btn btn-sm bg-warning" data-toggle="modal" data-target="#exampleModalss{{$i}}"><i class="fas fa-edit"></i></button></td>
                    <td align="center"><button type="button" class="btn btn-sm bg-danger" data-toggle="modal" data-target="#exampleModals{{$i}}"><i class="fas fa-trash"></i></button></td>
                    </tr>
                   <div class="modal fade" id="exampleModals{{$i}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <form method="post" action="{{route('delete_user')}}">
                        @csrf
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Hapus Data User</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          <div class="modal-body">
                            Apakah anda yakin ingin menghapus data {{$d->username}}?
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="text" value="{{$d->id_user}}" name="del"style="display:none">
                            <input  type="submit" class="btn btn-sm bg-danger" value="DELETE">
                          </div>
                        </div>
                        </form>
                      </div>
                    </div>
                    
                    <div class="modal fade" id="exampleModalss{{$i}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                      <form method="post" action="{{route('edit_user')}}">
                      @csrf
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">EDIT Data User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="form-group row" style="margin-left:-120px;">
                              <label class="col-sm-2 col-form-label" style="margin-left: 150px;">Fullname</label>
                              <div class="col-sm-6">
                                <input type="text" name="fullname" class="form-control" value="<?=$d->fullname?>" placeholder="" required>
                              </div>
                            </div> 
                            <div class="form-group row" style="margin-left:-120px;">
                              <label class="col-sm-2 col-form-label" style="margin-left: 150px;">Username</label>
                              <div class="col-sm-6">
                                <input type="" name="username" class="form-control" placeholder="" value="<?=$d->username?>" required>
                              </div>
                            </div>  
                            <div class="form-group row" style="margin-left:-120px;">
                              <label class="col-sm-2 col-form-label" style="margin-left: 150px;">Password</label>
                              <div class="col-sm-6">
                                <input type="password" name="password" class="form-control" placeholder="" required>
                              </div>
                            </div>     
                            
                          </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <input type="text" value="{{ $d->id_user }}" name="del"style="display:none">
                          <input  type="submit" class="btn btn-sm bg-warning" value="EDIT">
                        </div>
                      </div>
                      </form>
                      </div>
                    </div>
                    {{$i++}}
                  @endforeach

                  </tbody>
                </table>
          </div>
              <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
  <form method="post" action="{{ route('add_user') }}">
  @csrf
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
        <div class="form-group row" style="margin-left:-120px;">
          <label class="col-sm-2 col-form-label" style="margin-left: 150px;">Fullname</label>
          <div class="col-sm-6">
            <input type="text" name="fullname" class="form-control" placeholder="" required>
          </div>
        </div> 
        <div class="form-group row" style="margin-left:-120px;">
          <label class="col-sm-2 col-form-label" style="margin-left: 150px;">Username</label>
          <div class="col-sm-6">
            <input type="" name="username" class="form-control" placeholder="" required>
          </div>
        </div>  
        <div class="form-group row" style="margin-left:-120px;">
          <label class="col-sm-2 col-form-label" style="margin-left: 150px;">Password</label>
          <div class="col-sm-6">
            <input type="password" name="password" class="form-control" placeholder="" required>
          </div>
        </div>   
        
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input  type="submit" class="btn btn-primary" value="Simpan data">
      </div>
    </div>
     </form>
  </div>
</div>

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script>
$(document).ready(function() {
    $(".show_hide_password a").on('click', function(event) {
        event.preventDefault();
        if($('.show_hide_password input').attr("type") == "text"){
            $('.show_hide_password input').attr('type', 'password');
            $('.show_hide_password i').addClass( "fa-eye-slash" );
            $('.show_hide_password i').removeClass( "fa-eye" );
        }else if($('.show_hide_password input').attr("type") == "password"){
            $('.show_hide_password input').attr('type', 'text');
            $('.show_hide_password i').removeClass( "fa-eye-slash" );
            $('.show_hide_password i').addClass( "fa-eye" );
        }
    });
});
</script>
@include('../template/footer');