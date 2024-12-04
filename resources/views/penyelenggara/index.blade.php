@include('../template/header');
@include('../template/sidebar');

<style>
        .cb {
            display: inline-block;
            position: relative;
            padding-left: 12px;
            cursor: pointer;
        }
          
        /* Hide the default checkbox */
          
        .marks {
            position: absolute;
            top: 0;
            left: 0;
            height: 20px;
            width: 20px;
            background-color: white;
            border : 1px solid black;
        }
          
        .harga {
            width: 75px;
            padding:10px;
            border : 1px solid black;
            background-color: white;
        }
        .mark {
            width: 150px;
            padding:10px;
            border : 1px solid white;
            background-color: grey;
        }
          
        .mark0 {
            width: 150px;
            padding:10px;
            border : 1px solid white;
            background-color: red;
        }
        .mark1 {
            width: 150px;
            padding:10px;
            border : 1px solid white;
            background-color: brown;
        }
        .mark2 {
            width: 150px;
            padding:10px;
            border : 1px solid white;
            background-color: lime;
        }
        .mark3 {
            width: 150px;
            padding:10px;
            border : 1px solid white;
            background-color: orange;
        }
        .mark4 {
            width: 150px;
            padding:10px;
            border : 1px solid white;
            background-color: #b0c4dd;
        }
        .mark5 {
            width: 150px;
            padding:10px;
            border : 1px solid white;
            background-color: yellow;
        }
        .mark6 {
            width: 150px;
            padding:10px;
            border : 1px solid white;
            background-color: purple;
        }
        .mark7 {
            width: 150px;
            padding:10px;
            border : 1px solid white;
            background-color: pink;
        }
        .mark8 {
            width: 150px;
            padding:10px;
            border : 1px solid white;
            background-color: skyblue;
        }
        .mark9 {
            width: 150px;
            padding:10px;
            border : 1px solid white;
            background-color: blue;
        }
        .disable {
            position: absolute;
            top: 0;
            left: 0;
            height: 20px;
            width: 17px;
            font-size:6px;
            background-color: grey;
            border : 1px solid black;
        }
        .markp {
            position: absolute;
            top: 0;
            left: 0;
            height: 20px;
            width: 15px;
            font-size:6px;
            background-color: white;
            border : 1px solid black;
        }
          
        .name {
            position: absolute;
            top: 0;
            left: 0;
            height: 20px;
            width: 15px;
        }
          
    </style>
<?php
  $s_kursi=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','Q','R','S','T','U','V','W','X','Y','Z');
  $b_kursi=array('BA','BB','BC','BD','BE','BF','BG','BH','BJ','BK','BL','BM','BN','BO','BP','BQ','BR','BS','BT','BU','BV','BW','BX');
  $kolom= array(23,26,32,35,45,48,47,50,52,47,48,49,46,49,48,44,38,36,32,29);
  $kolomb= array(48,49,46,43,40,37,32,27,24,23);?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background-color: #395B64">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0" style="color:#E7F6F2"><b><?=$title?></b></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
				<li class="breadcrumb-item active">{{$title}} | PENYELENGGARA</li>
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
            <div class="card-header" style="background-color:#A5C9CA">
              <h3 class="card-title">
                <i class="fas fa-money-bill-wave mr-1"></i>
                  Home
              </h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
              <div class="row">
				<div class="col-3">Poster</div>
                <div class="col-3">Nama Pertunjukan</div>
                <div class="col-3">Nama Venue</div>
                <div class="col-3">Detail</div>
              </div>
              <hr>
            <?php $i = 1;$zz=0;$tt=1;?>
				<?php 
					$jams =[];
				?>
                @foreach ($data_user as $d)
                <?php
                  $jam_tayang=[];
                  $tanggal_tayang=[];
                  $waktu_tayang = json_decode($d->waktu_tayang);
				  $waktu = json_decode($d->waktu_tayang);
					$tanggal = array();
					$jam = array();
					$jumlah_array=0;
					foreach($waktu as $w){
						$tanggal[$jumlah_array] = $w[0];
						$jam[$jumlah_array] = $w[1];
						$jumlah_array++;
					}
					array_push($jams,$jam);
                
                ?>
                  <div class="row">
					<div class="col-3"><image src="uploads/{{$d->poster }}" width="100px" style="border-radius: 10px"></div>
                    <div class="col-3">{{ $d->nama_aktivitas }} </div>
                    <div class="col-3">{{ $d->nama_venue }}</div>
                    <div class="col-3" ><button type="button" class="btn btn-sm bg-info" data-toggle="modal" data-target="#exampleModals{{$i}}"><i class="fas fa-search"></i></button></div>
                  </div>
                  <hr>
                   <div class="modal fade" id="exampleModals{{$i}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
                      <div class="modal-xl modal-dialog" role="document">
                        <div class="modal-content" style="background-color:#E7F6F2">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Detail Penjualan</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          <div class="modal-body" style="overflow-y:scroll;min-height:1000px">
						  <p class=""><b>Tanggal Tayang: </b>
							<select class="form-control" id="tanggal_tayang{{$tt}}">
								  <option disabled selected>Pilih Tanggal Tayang</option>
								  @foreach($tanggal as $tang)
								  <option value="{{$tang}}">{{$tang}}</option>
									
								  @endforeach
							</select>
						  </p>
						  <p class=""><b>Waktu : </b>
							<select  class="form-control" id="jam_tayang{{$tt}}">
							</select>
						  </p>
						  <ul class="nav nav-tabs">
							<li class="active"><a data-toggle="tab" class="nav-link" href="#tabel{{$tt}}">Tabel</a></li>
							<li><a data-toggle="tab" class="nav-link" href="#seatmap{{$tt}}">Seatmap</a></li>
						  </ul>
						  <div class="tab-content">
							<div id="tabel{{$tt}}" class="tab-pane fade in active" style="padding-top:50px">
							  @foreach ($waktu_tayang as $dd)
								<?php $nomor=1;?>
								@foreach ($dd[1] as $ddd)
								<div class="{{implode('',explode('-',$dd[0]))}}_{{implode('',explode(':',$ddd))}}">
									<input class="validasi1" type="hidden" value="{{$dd[0]}}_{{$ddd}}">
									<table id="example3<?=$zz?>" class="table " >
										<thead>
										<tr>
											<th>Nomor</th>
											<th>Section</th>
											<th>Pertunjukan</th>
											<th>Tanggal Penayangan</th>
											<th>Jam Penayangan</th>
											<th>Harga per Kursi</th>
											<th>Kursi Terjual</th>
											<th>Jumlah</th>
											<th>Total Penjualan per Section</th>
										</tr>
										</thead>
										<?php $total_semua=0;?>
										<tbody>
										@foreach ($section as $dddd)
										@if($d->id_aktivitas == $dddd->id_aktivitas)
										<?php
											$seat = array();
											$ar = explode(",",$dddd->no_bangku);
											$at = explode(",",$dddd->no_bangku);
											foreach($ar as $d1){
												foreach($transaksi as $tr){
													if($tr->no_bangku == $d1 && $tr->waktu_tayang ==  $ddd&& $tr->tanggal_tayang ==  $dd[0]){
														array_push($seat,$d1);
													}
												}
											}
										?>
										<tr>
											<td>{{$nomor++}}</td>
											<td>{{$dddd->nama_section}}</td>
											<td>{{$d->nama_aktivitas}}</td>
											<td>{{$dd[0]}}</td>
											<td>{{$ddd}}</td>
											<td>Rp{{number_format($dddd->harga,0,',','.')}}</td>
											<td>{{implode(',',$seat)}}</td>
											<td>{{count($seat)}}</td>
											<td>Rp{{number_format(count($seat)*$dddd->harga,0,',','.')}}</td>
										</tr>
										<?php $total_semua+=count($seat)*$dddd->harga;?>
										@endif
										@endforeach
										<tr>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td>Total</td>
											<td>Rp{{number_format($total_semua,0,',','.')}}</td>
										</tr>
										</tbody>
									</table>
								</div><?php $zz++;?>
								@endforeach
							@endforeach
						  </div>
							<div id="seatmap{{$tt}}" class="tab-pane fade">
							  
							  @foreach ($waktu_tayang as $dd)
								<?php $nomor=1;?>
								@foreach ($dd[1] as $ddd)
								<div class="{{implode('',explode('-',$dd[0]))}}_{{implode('',explode(':',$ddd))}}1">
									
								  @foreach($layout as $l)
								  <?php if($l->id_aktivitas == $d->id_aktivitas){ ?>
								  <?php 
								  $temp=array();
								  $arr = explode(',',$l->no_bangku);
								  for($i=0;$i<count($arr);$i+=5){
									  array_push($temp,[$arr[$i],$arr[$i+1],$arr[$i+2],$arr[$i+3],$arr[$i+4]]);
								  }
									for($i=0;$i<count($temp);$i++){
										  $ada=0;
										  foreach($section as $s ){
											  $ar = explode(',',$s->no_bangku);
											  foreach($ar as $ss ){
												  if($ss == ($temp[$i][4].$temp[$i][3])){
													  $temp[$i][5] = $s->warna;
													  $temp[$i][6] = $s->harga;
													  $ada = 1;
													  break;
												  }
												
											  }
										  }
										  if($ada == 0){
											  $temp[$i][5] = "grey";
											  $temp[$i][6] = -1;
										  }
									}
								  
								  ?>
									<h2 align="center">{{$l->nama_layout}}</h2><h2 align="center">Stage</h2>
									<div class="container-fluid position-relative" id="canvas'+i+'" align="center" style="overflow:scroll;width:1000px;height:700px">
									<br>
									<?php $seat=[];?>
									@foreach ($section as $dddd)
										@if($d->id_aktivitas == $dddd->id_aktivitas)
										<?php
											$ar = explode(",",$dddd->no_bangku);
											$at = explode(",",$dddd->no_bangku);
											foreach($ar as $d1){
												foreach($transaksi as $tr){
													if($tr->no_bangku == $d1 && $tr->waktu_tayang ==  $ddd&& $tr->tanggal_tayang ==  $dd[0]){
														array_push($seat,$d1);
													}
												}
											}
										?>
										@endif
										@endforeach
									<?php foreach($temp as $t){ 
									$disable = 0;
									foreach($seat as $data_bangku){
										if($data_bangku == $t[4].$t[3]){
											$disable=1;
											break;
										}
									}
									if($t[2] == 0 && $t[6]!=-1 && $disable ==0 ){?>
									<div class='markp' style='background-color:{{$t[5]}};width:25px;height:25px;position:absolute;border:1px solid black;font-size:7px;color:black;top:{{$t[0]}}px;left:{{$t[1]}}px'>{{$t[4]}}{{$t[3]}}</div>
									<?php }else{?>
									<div class='ui-widget-content' class='' style='background-color:grey;width:25px;height:25px;position:absolute;border:1px solid black;font-size:7px;color:black;top:{{$t[0]}}px;left:{{$t[1]}}px'>{{$t[4]}}{{$t[3]}}</div>
									<?php } }?>
									</div>
									<br><br><br>
								  <?php }?>
								  @endforeach
								</div><?php $zz++;?>
								@endforeach
							@endforeach
							</div>
							
						  <?php $tt++;?>

                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
                            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
                            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
                          </div>
                        </div>
                      </div>
                    </div>
                                      <?php $i++;?>
                </div>
                  @endforeach

          </div>
              <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@include('../template/footer');
<script>
  $(function () {
	<?php for($k=0;$k<$zz;$k++){?>
    $("#example3<?=$k?>").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false, "ordering": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example3<?=$k?>_wrapper .col-md-6:eq(0)');
	<?php }?>
  });
</script>
                            <script type="text/javascript">
      $(document).ready(function(){
        $('.validasi1').each(function(p, obj) {
			var strs = this.value.split("-");
			var strss = strs.join("");
			strs = strss.split(":");
			strss = strs.join("");
			$("#"+strss).hide();
			$("#"+strss+"1").hide();
		});      
		var jams= [
			<?php for($i=0;$i<count($jams);$i++){?>
			[
				<?php for($j=0;$j<count($jams[$i]);$j++){?>
					{
						'':'Pilih Jam Tayang',
					<?php for($k=0;$k<count($jams[$i][$j]);$k++){?>
						'<?= $jams[$i][$j][$k]?>':'<?= $jams[$i][$j][$k]?>',
					<?php }?>
					},
				<?php }?>
			],
			<?php }?>
		];  
		<?php for($i=0;$i<count($jams);$i++){?>
            $('#tanggal_tayang<?=$i+1?>').on('change', function() {
               tanggal=$(this).val();
			   $('#jam_tayang<?=$i+1?>').empty();
			   $.each(jams[<?=$i?>][$("#tanggal_tayang<?=$i+1?> option:selected").index()-1], function(key,value) {
				  $('#jam_tayang<?=$i+1?>').append($("<option></option>")
					 .attr("value", value).text(value));
				});
               $('input[name=tanggal_tayang<?=$i+1?>]').val($(this).val());
            });
            $('#jam_tayang<?=$i+1?>').on('change', function() {
              jam = $(this).val();
               $('input[name=jam_tayang<?=$i+1?>]').val($(this).val());
				var ada=0;
				$('.validasi1').each(function(p, obj) {
					var str = tanggal+'_'+jam;
					var strs = this.value.split("-");
					var strss = strs.join("");
					strs = strss.split(":");
					strss = strs.join("");
					if(str == this.value && ada==0){
						$("."+strss+':eq(0)').show();
						$("."+strss+'1:eq(0)').show();
						ada=1;
					}
					else{
						$("."+strss).hide();
						$("."+strss+'1').hide();
					}
					//test
				});
            });
			
				$('.validasi1').each(function(p, obj) {
					var strs = this.value.split("-");
					var strss = strs.join("");
					strs = strss.split(":");
					strss = strs.join("");
						$("."+strss).hide();
						$("."+strss+'1').hide();
					//test
				});
		<?php }?>
		
      });
                            </script>