<!DOCTYPE html>
<html>
<head>
	<title>Generate Nomor Surat</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="icon" href="../../favicon.png" type="png" sizes="16x16">

	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">


    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../../style5.css">

	 <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

	<script>
		 $(function(){

		    $(".dropdown-menu").on('click', 'a', function(){
		      $(".btn:first-child").text($(this).text());
		      $(".btn:first-child").val($(this).text());
		   });

		});

		 $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $(this).toggleClass('active');
            });
        });
  	</script>

</head>



<body>

<div class="wrapper">
        <!-- Sidebar Holder -->
       <nav id="sidebar">
            <img style="height: 100px; margin-top: 30px;" src="../../logo.png" class="rounded mx-auto d-block">
            <div class="sidebar-header">
                <h3></h3>
            </div>

            {% if (session.get('admin')['username']) %}
            <ul style="margin-left: 10px;" class="list-unstyled">

                <!-- <li>
                    <a href="{{ url('') }}">Generate Nomor Surat</a>
                </li>
                <li>
                    <a href="{{ url('surat/list') }}">Upload Surat</a>
                </li> -->
                
                <li>
                    <a href="{{ url('admin/list') }}">Beranda Admin</a>
                </li>
                <li>
                    <a href="{{ url('admin/verif') }}">Verifikasi Akun User</a>
                </li>
                <li>
                    <a href="{{ url('admin/jenissurat') }}">Tambah Jenis Surat</a>
                </li>
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">{{ session.get('admin')['username'] }}</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="{{ url('admin/register') }}">Daftar</a>
                        </li>
                        <li>
                            <a href="{{ url('user/logout') }}">Keluar</a>
                        </li>
                    </ul>
                </li>
            </ul>

            {% else %}

            <ul style="margin-left: 10px;" class="list-unstyled">

                <li>
                    <a href="{{ url('') }}">Generate Nomor Surat</a>
                </li>
                <li>
                    <a href="{{ url('surat/list') }}">Upload Surat</a>
                </li>
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">{{ session.get('user')['username'] }}</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="{{ url('user/logout') }}">Keluar</a>
                        </li>
                        <!-- <li>
                            <a href="{{ url('admin/logout') }}">Keluar</a>
                        </li> -->
                    </ul>
                </li>
            </ul>
            {% endif %}


        </nav>



        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="">

                    <button style="margin-right: 30px;" type="button" id="sidebarCollapse" class="navbar-btn">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    <h2 style="font-family:'GothamRounded-Medium'; float: right;">Upload Surat</h2>
                    <!--  <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button> -->



                </div>
            </nav>
            



<!-- ini buat nomor -->

<h4 style="margin-top: 30px; margin-left: 90px;">Nomor surat anda: {{data.no_surat}}</h4>

<!-- ini buat nomor -->


	<form action="{{ url("surat/storeupload") }}" method = "post" enctype="multipart/form-data" style="margin-left: 90px; margin-top: 40px; width: 25%; font-family:'GothamRounded-Medium';">
	  
        {% if data.pengecekan == 1 %}
            <div class="alert alert-success" role="alert">
                Surat ini telah <a class="alert-link">berhasil diunggah</a> oleh <a class="alert-link">{{data.nama_pengupload}}</a>.
                <a style="font-size: 10pt;" href="../../surat/download/{{data.id}}" class="btn btn-primary">Download File Surat</a>
            </div>
            <div style="font-size: 10pt;" class="alert alert-primary" role="alert">
                Surat telah diverifikasi oleh admin.
            </div>
        {% elseif data.pengecekan == -1 %}
            <div class="alert alert-success" role="alert">
                Surat ini telah <a class="alert-link">berhasil diunggah</a> oleh <a class="alert-link">{{data.nama_pengupload}}</a>.
                <a style="font-size: 10pt;" href="../../surat/download/{{data.id}}" class="btn btn-primary">Download File Surat</a>
            </div>
            <div style="font-size: 10pt;" class="alert alert-danger" role="alert">
                Verifikasi ditolak oleh admin.
            </div>
        {% elseif data.pengecekan == 0 %}
            {% if data.file != NULL %}
                <div class="alert alert-success" role="alert">
                    Surat ini telah <a class="alert-link">berhasil diunggah</a> oleh <a class="alert-link">{{data.nama_pengupload}}</a>.
                    <a style="font-size: 10pt;" href="../../surat/download/{{data.id}}" class="btn btn-primary">Download File Surat</a>
                </div>
                <div style="font-size: 10pt;" class="alert alert-danger" role="alert">
                    Apabila ingin mengubah file yang telah diunggah, silahkan mengunggah kembali pada form di bawah.
                </div>
            {% endif %}
            <p><?php echo $this->flashSession->output() ?></p>
    
                <div  class="form-group">
                    <div style="font-size: 10pt;" class="alert alert-primary" role="alert">
                    Ukuran file <a class="alert-link">maksimal 5 MB</a><br>Pastikan file yang diunggah berekstensi <a class="alert-link">.pdf</a>
                    </div>

                    <input type="hidden" name="id" class="form-control" value={{data.id}}>
                </div>
                    <div style="margin-top: 15px;">
                    <label>Unggah Surat</label>
                </div>

                        <input style="font-size: 10pt;" type="file" name="file" required>		
                <div>	
                <button style="margin-top: 50px; margin-bottom: 50px;" type="submit" class="btn btn-primary">Unggah Surat</button>
                <a href="{{ url('surat/list') }}" style="margin-top: 50px; margin-bottom: 50px;"" class="btn btn-danger">Kembali</a>
                </div>
                </form>
        {% endif %}

</body>

</html>