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
                    <a href="{{ url() }}">Generate Nomor Surat</a>
                </li>
                <li>
                    <a href="{{ url('admin/listupload') }}">Upload Surat</a>
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
                    <a href="{{ url('surat/daftarsurat') }}">List Surat</a>
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
                    <h2 style="font-family:'GothamRounded-Medium'; float: right;">Detail Surat</h2>
                    <!--  <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button> -->



                </div>
            </nav>
            

    <h2 style="margin-top: 30px; margin-left: 90px;">Detail {{data.no_surat}}</h2>
            {% if (data.file) %}
                {% if (data.pengecekan == 1 OR data.pengecekan == -1) %}
                <!-- Kalau sudah diverif -->
                <div style="font-size: 10pt; margin-top: 30px; width: 35%; margin-left: 90px;" class="alert alert-success" role="alert">
                    Surat ini sudah diverifikasi oleh admin.
                    <a href="../urungkan/{{data.id}}" style="font-size: 10pt;margin-left: 20px;" class="btn btn-danger">Urungkan Verifikasi</a>
                </div>
                {% else %}
                <!-- Kalau belum diverif -->
                <div style="font-size: 10pt; margin-top: 30px; width: 41%; margin-left: 90px;" class="alert alert-danger" role="alert">
                    Surat ini belum diverifikasi oleh admin.
                    <a href="../verifikasi/{{data.id}}" style="font-size: 10pt;margin-left: 20px;" class="btn btn-success">Verifikasi Sekarang</a>
                    <a href="../tolak/{{data.id}}" style="font-size: 10pt;margin-left: 20px;" class="btn btn-dark">Tolak</a>
                </div>
                {% endif %}
            {% endif %}
            <ul style="margin-top: 40px;  margin-left: 90px; margin-right: 50%;" class="list-group">
                <li class="list-group-item list-group-item-primary">Nama: {{data.name}}</li>
                <li class="list-group-item list-group-item-primary">Nama Surat: {{data.nama_surat}}</li>
                <li class="list-group-item list-group-item-primary">Jenis Surat:
                {% if (data.jenis_surat == 1) %}
                Berita acara penjelasan
                {% elseif (data.jenis_surat == 2) %}
                Berita acara siap operasi (BASO)
                {% elseif (data.jenis_surat == 3) %}
                Berita acara delete order (BADO)
                {% elseif (data.jenis_surat == 4) %}
                Surat keluar
                {% elseif (data.jenis_surat == 5) %}
                P0/P1
                {% elseif (data.jenis_surat == 6) %}
                Surat penawaran
                {% endif %}
                
                </li>
                <li class="list-group-item list-group-item-primary">No Surat: {{data.no_surat}}</li>
                <li class="list-group-item list-group-item-primary">Tanggal: {{data.tanggal}}</li>
                <li class="list-group-item list-group-item-primary">Status: 
                 {% if (data.pengecekan == 1) %}
                TERVERIFIKASI
                {% elseif (data.pengecekan == -1) %}
                DITOLAK
                {% else %}
                BELUM VERIFIKASI
                {% endif %}
                </li>

                {% if (data.file) %}
                <li class="list-group-item list-group-item-primary">Nama Pengunggah: {{data.nama_pengupload}}</li>
                <li class="list-group-item list-group-item-primary"><a  href="../../surat/download/{{data.id}}" class="btn btn-primary">Download File Surat</a> </li>
                {% else %}
                <li class="list-group-item list-group-item-danger">File belum diunggah</li>
                {% endif %}
                
            </ul>

          

            <a href="{{ url('surat/list') }}" style="margin-top: 50px; margin-left: 90px;" class="btn btn-danger">Kembali</a>


</body>





</html>