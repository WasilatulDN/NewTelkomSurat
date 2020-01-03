<!DOCTYPE html>
<html>
<head>
	<title>Generate Nomor Surat</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="icon" href="favicon.png" type="png" sizes="16x16">

	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">


    <!-- Our Custom CSS -->
<!--     <link rel="stylesheet" type="text/html" href="style5.css"> -->

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


<h2 style="margin-top: 90px; margin-left: 90px;">Upload Surat Anda</h2>



	<form action="{{ url("storeupload") }}" method = "post" enctype="multipart/form-data" style="margin-left: 90px; margin-top: 40px; width: 25%; font-family:'GothamRounded-Medium';">
	  

      {%if data.file == NULL%}
      {% else %}

        <div class="alert alert-success" role="alert">
          Surat ini telah <a class="alert-link">berhasil diunggah</a> oleh <a class="alert-link">{{data.nama_pengupload}}</a>.
        </div>

        <div style="font-size: 10pt;" class="alert alert-danger" role="alert">
          Apabila ingin mengubah file yang telah diunggah, silahkan mengunggah kembali pada form di bawah.
        </div>
      {% endif %}
      <div  class="form-group">
        <div style="font-size: 10pt;" class="alert alert-primary" role="alert">
          Ukuran file <a class="alert-link">maksimal 2 MB</a><br>Pastikan file yang diunggah berekstensi <a class="alert-link">.pdf atau .jpg</a>.
        </div>

        <input type="hidden" name="id" class="form-control" value={{data.id}}>
        <label>Nama Anda</label>
        <input type="text" class="form-control" name="pengupload" placeholder="Masukkan nama anda" required>
      </div>
        <div style="margin-top: 15px;">
	  	<label>Unggah Surat</label>
	  </div>

    		<input style="font-size: 10pt;" type="file" name="file" required>		
    <div>	
        <p>{{messages['file']}}</p>
	  <button style="margin-top: 50px; margin-bottom: 50px;" type="submit" class="btn btn-primary">Unggah Surat</button>
	  <button href="{{ url('detailnomor') }}" style="margin-top: 50px; margin-bottom: 50px;"" class="btn btn-danger">Kembali</button>
    </div>
	</form>

	

</body>










<style>
    /*
    DEMO STYLE
*/
@import "https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700";

@font-face {
        font-family:'GothamRounded-Medium';
        src:url('https://assets.lydian.io/fonts/GothamRounded-Medium.eot?#iefix') format('embedded-opentype'), url('https://assets.lydian.io/fonts/GothamRounded-Medium.otf') format('opentype'), url('https://assets.lydian.io/fonts/GothamRounded-Medium.woff') format('woff'), url('https://assets.lydian.io/fonts/GothamRounded-Medium.ttf') format('truetype'), url('https://assets.lydian.io/fonts/GothamRounded-Medium.svg#GothamRounded-Medium') format('svg');
        font-weight:400;
        font-style:normal
        }
        @font-face {
        font-family:'GothamRounded-Book';
        src:url('https://assets.lydian.io/fonts/GothamRounded-Book.eot?#iefix') format('embedded-opentype'), url('https://assets.lydian.io/fonts/GothamRounded-Book.otf') format('opentype'), url('https://assets.lydian.io/fonts/GothamRounded-Book.woff') format('woff'), url('https://assets.lydian.io/fonts/GothamRounded-Book.ttf') format('truetype'), url('https://assets.lydian.io/fonts/GothamRounded-Book.svg#GothamRounded-Book') format('svg');
        font-weight:400;
        font-style:normal
        }
        @font-face {
        font-family:'GothamRounded-Light';
        src:url('https://assets.lydian.io/fonts/GothamRounded-Light.eot?#iefix') format('embedded-opentype'), url('https://assets.lydian.io/fonts/GothamRounded-Light.otf') format('opentype'), url('https://assets.lydian.io/fonts/GothamRounded-Light.woff') format('woff'), url('https://assets.lydian.io/fonts/GothamRounded-Light.ttf') format('truetype'), url('https://assets.lydian.io/fonts/GothamRounded-Light.svg#GothamRounded-Light') format('svg');
        font-weight:400;
        font-style:normal
        }
        @font-face {
        font-family:'Conv_GothamRnd-Bold';
        src:url('https://assets.lydian.io/fonts/GothamRnd-Bold.eot') format('embedded-opentype'), url('https://assets.lydian.io/fonts/GothamRnd-Bold.woff') format('woff'), url('https://assets.lydian.io/fonts/GothamRnd-Bold.ttf') format('truetype'), url('https://assets.lydian.io/fonts/GothamRnd-Bold.svg') format('svg');
        font-weight:400;
        font-style:normal
        }
body {
    font-family: 'GothamRounded-Medium', sans-serif;
    background: #fafafa;
}

p {
    font-family: 'GothamRounded-Medium', sans-serif;
    font-size: 1.1em;
    font-weight: 300;
    line-height: 1.7em;
    color: #999;
}

a, a:hover, a:focus {
    color: inherit;
    text-decoration: none;
    transition: all 0.3s;
}

.navbar {
    padding: 15px 10px;
    background: #fff;
    border: none;
    border-radius: 0;
    margin-bottom: 40px;
    box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
}

.navbar-btn {
    box-shadow: none;
    outline: none !important;
    border: none;
}

.line {
    width: 100%;
    height: 1px;
    border-bottom: 1px dashed #ddd;
    margin: 40px 0;
}

/* ---------------------------------------------------
    SIDEBAR STYLE
----------------------------------------------------- */

.wrapper {
    display: flex;
    width: 100%;
    align-items: stretch;
    perspective: 1500px;
}


#sidebar {
    min-width: 250px;
    max-width: 250px;
    background: #8a8784;
    color: #fff;
    transition: all 0.6s cubic-bezier(0.945, 0.020, 0.270, 0.665);
    transform-origin: bottom left;
}

#sidebar.active {
    margin-left: -250px;
    transform: rotateY(100deg);
}

#sidebar .sidebar-header {
    padding: 20px;
    background: #8a8784;
}

#sidebar ul.components {
    padding: 20px 0;
    border-bottom: 1px solid #47748b;
}

#sidebar ul p {
    color: #fff;
    padding: 10px;
}

#sidebar ul li a {
    padding: 10px;
    font-size: 1.1em;
    display: block;
}
#sidebar ul li a:hover {
    color: #e00025;
    background: #fff;
}

#sidebar ul li.active > a, a[aria-expanded="true"] {
    color: #fff;
    background: #e00025;
}

.modal.fade{
-webkit-transition:opacity .3s linear, top .3s ease-out;
-moz-transition:opacity .3s linear, top .3s ease-out;
-ms-transition:opacity .3s linear, top .3s ease-out;
-o-transition:opacity .3s linear, top .3s ease-out;
transition:opacity .3s linear, top .3s ease-out;
top:-25%;}

/*a[data-toggle="collapse"] {
    position: relative;
}
*/


ul ul a {
    font-size: 0.9em !important;
    padding-left: 30px !important;
    background: #e00025;
}

ul.CTAs {
    padding: 20px;
}

ul.CTAs a {
    text-align: center;
    font-size: 0.9em !important;
    display: block;
    border-radius: 5px;
    margin-bottom: 5px;
}

a.download {
    background: #fff;
    color: #e00025;
}

a.article, a.article:hover {
    background: #e00025 !important;
    color: #fff !important;
}



/* ---------------------------------------------------
    CONTENT STYLE
----------------------------------------------------- */
#content {
    width: 100%;
    padding: 20px;
    min-height: 100vh;
    transition: all 0.3s;
}

#sidebarCollapse {
    width: 40px;
    height: 40px;
    background: #f5f5f5;
    cursor: pointer;
}

#sidebarCollapse span {
    width: 80%;
    height: 2px;
    margin: 0 auto;
    display: block;
    background: #555;
    transition: all 0.8s cubic-bezier(0.810, -0.330, 0.345, 1.375);
    transition-delay: 0.2s;
}

#sidebarCollapse span:first-of-type {
    transform: rotate(45deg) translate(2px, 2px);
}
#sidebarCollapse span:nth-of-type(2) {
    opacity: 0;
}
#sidebarCollapse span:last-of-type {
    transform: rotate(-45deg) translate(1px, -1px);
}


#sidebarCollapse.active span {
    transform: none;
    opacity: 1;
    margin: 5px auto;
}


/* ---------------------------------------------------
    MEDIAQUERIES
----------------------------------------------------- */
@media (max-width: 768px) {
    #sidebar {
        margin-left: -250px;
        transform: rotateY(90deg);
    }
    #sidebar.active {
        margin-left: 0;
        transform: none;
    }
    #sidebarCollapse span:first-of-type,
    #sidebarCollapse span:nth-of-type(2),
    #sidebarCollapse span:last-of-type {
        transform: none;
        opacity: 1;
        margin: 5px auto;
    }
    #sidebarCollapse.active span {
        margin: 0 auto;
    }
    #sidebarCollapse.active span:first-of-type {
        transform: rotate(45deg) translate(2px, 2px);
    }
    #sidebarCollapse.active span:nth-of-type(2) {
        opacity: 0;
    }
    #sidebarCollapse.active span:last-of-type {
        transform: rotate(-45deg) translate(1px, -1px);
    }

}

</style>

</html>