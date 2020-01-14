public function exportAction()
    {
        //Declaring css
        $header_css = "PUT Your CSS if needed";
        $data_css = "PUT Your CSS if needed";
        //If data comes from model then
        $data = $this->modelsManager->createBuilder()
        ->columns("nomor_surat.id, nomor_surat.name, nomor_surat.nama_surat, nomor_surat.no_surat, nomor_surat.tanggal, nomor_surat.nama_pengupload, nomor_surat.pengecekan, jenis_surat.nama_surat as namajenis, nomor_surat.file")
        ->From('nomor_surat')
        ->innerjoin('jenis_surat', 'nomor_surat.jenis_surat = jenis_surat.id')
        // ->where(" file is not NULL ")
        ->getQuery()
        ->execute(); 
        //As i'm using join query i feel good using createBuilder
        // $data = $this->modelsManager->createBuilder()
        //       ->columns("comment.comment, comment.username, comment.email, comment.postedat,item.name,item.photo,item.view,item.categoryid,item.id")
        //       ->From('comment')
        //       ->innerjoin('item', 'comment.productid = item.id')
        //       ->where("comment.email = 'pass your value here' ")
        //       ->getQuery()
        //       ->execute(); 

        $table = "<table>
        <tr>
        <td style='$header_css'>No</td>
        <td style='$header_css'>Nama Pengupload</td>
        <td style='$header_css'>Nama Surat</td>
        <td style='$header_css'>Jenis Surat</td>
        <td style='$header_css'>Nomor Surat</td>
        <td style='$header_css'>Tanggal</td>
        <td style='$header_css'>Nama Pengupload</td>
        <td style='$header_css'>File</td>
        <td style='$header_css'>Status Verifikasi</td>
        </tr>";

        $no = 1;
        foreach ($data as $row) {

            if($row->pengecekan == 1)
            {
                $verifikasi = "Terverifikasi";
            }
            elseif($row->pengecekan == -1)
            {
                $verifikasi = "Ditolak";
            }
            else
            {
                $verifikasi = "Belum Verifikasi";
            }

            if($row->file == NULL){
                $file = "Belum Upload";
            }
            elseif($row->file != NULL){
                $file = "Sudah Upload";
            }

            $table.= "<tr>
            <td style='$data_css'>$no</td>
            <td style='$data_css'>$row->name</td>
            <td style='$data_css'>$row->nama_surat</td>
            <td style='$data_css'>$row->namajenis</td>
            <td style='$data_css'>$row->no_surat</td>
            <td style='$data_css'>$row->tanggal</td>
            <td style='$data_css'>$row->nama_pengupload</td>
            <td style='$data_css'>$file</td>
            <td style='$data_css'>$verifikasi</td>
            </tr>";
            $no ++;
        }
        $table.= '</table>';

        header ("Content-type: application/xls;charset=UTF-8");
        header ("Content-Disposition: attachment; filename=DataSurat.xls" );
        return $table;
    }

    public function exportSudahAction()
    {
        //Declaring css
        $header_css = "PUT Your CSS if needed";
        $data_css = "PUT Your CSS if needed";
        $data = $this->modelsManager->createBuilder()
        ->columns("nomor_surat.id, nomor_surat.name, nomor_surat.nama_surat, nomor_surat.no_surat, nomor_surat.tanggal, nomor_surat.nama_pengupload, nomor_surat.pengecekan, jenis_surat.nama_surat as namajenis, nomor_surat.file")
        ->From('nomor_surat')
        ->innerjoin('jenis_surat', 'nomor_surat.jenis_surat = jenis_surat.id')
        ->where(" file is not NULL ")
        ->getQuery()
        ->execute(); 
        //As i'm using join query i feel good using createBuilder
        // $data = $this->modelsManager->createBuilder()
        //       ->columns("comment.comment, comment.username, comment.email, comment.postedat,item.name,item.photo,item.view,item.categoryid,item.id")
        //       ->From('comment')
        //       ->innerjoin('item', 'comment.productid = item.id')
        //       ->where("comment.email = 'pass your value here' ")
        //       ->getQuery()
        //       ->execute(); 

        $table = "<table>
        <tr>
        <td style='$header_css'>No</td>
        <td style='$header_css'>Nama Pengupload</td>
        <td style='$header_css'>Nama Surat</td>
        <td style='$header_css'>Jenis Surat</td>
        <td style='$header_css'>Nomor Surat</td>
        <td style='$header_css'>Tanggal</td>
        <td style='$header_css'>Nama Pengupload</td>
        <td style='$header_css'>File</td>
        <td style='$header_css'>Status Verifikasi</td>
        </tr>";

        $no = 1;
        foreach ($data as $row) {

            if($row->pengecekan == 1)
            {
                $verifikasi = "Terverifikasi";
            }
            elseif($row->pengecekan == -1)
            {
                $verifikasi = "Ditolak";
            }
            else
            {
                $verifikasi = "Belum Verifikasi";
            }


            if($row->file == NULL){
                $file = "Belum Upload";
            }
            elseif($row->file != NULL){
                $file = "Sudah Upload";
            }

            $table.= "<tr>
            <td style='$data_css'>$no</td>
            <td style='$data_css'>$row->name</td>
            <td style='$data_css'>$row->nama_surat</td>
            <td style='$data_css'>$row->namajenis</td>
            <td style='$data_css'>$row->no_surat</td>
            <td style='$data_css'>$row->tanggal</td>
            <td style='$data_css'>$row->nama_pengupload</td>
            <td style='$data_css'>$file</td>
            <td style='$data_css'>$verifikasi</td>
            </tr>";

            $no++;
        }
        $table.= '</table>';

        header ("Content-type: application/xls;charset=UTF-8");
        header ("Content-Disposition: attachment; filename=SuratSudahUpload.xls" );
        return $table;
    }

    public function exportBelumAction()
    {
        //Declaring css
        $header_css = "PUT Your CSS if needed";
        $data_css = "PUT Your CSS if needed";
        //If data comes from model then
        $data = $this->modelsManager->createBuilder()
        ->columns("nomor_surat.id, nomor_surat.name, nomor_surat.nama_surat, nomor_surat.no_surat, nomor_surat.tanggal, nomor_surat.nama_pengupload, nomor_surat.pengecekan, jenis_surat.nama_surat as namajenis, nomor_surat.file")
        ->From('nomor_surat')
        ->innerjoin('jenis_surat', 'nomor_surat.jenis_surat = jenis_surat.id')
        ->where(" file is NULL ")
        ->getQuery()
        ->execute(); 
        //As i'm using join query i feel good using createBuilder
        // $data = $this->modelsManager->createBuilder()
        //       ->columns("comment.comment, comment.username, comment.email, comment.postedat,item.name,item.photo,item.view,item.categoryid,item.id")
        //       ->From('comment')
        //       ->innerjoin('item', 'comment.productid = item.id')
        //       ->where("comment.email = 'pass your value here' ")
        //       ->getQuery()
        //       ->execute(); 

        $table = "<table>
        <tr>
        <td style='$header_css'>No</td>
        <td style='$header_css'>Nama Pengupload</td>
        <td style='$header_css'>Nama Surat</td>
        <td style='$header_css'>Jenis Surat</td>
        <td style='$header_css'>Nomor Surat</td>
        <td style='$header_css'>Tanggal</td>
        <td style='$header_css'>Nama Pengupload</td>
        <td style='$header_css'>File</td>
        <td style='$header_css'>Status Verifikasi</td>
        </tr>";

        $no=1;
        foreach ($data as $row) {

            if($row->pengecekan == 1)
            {
                $verifikasi = "Terverifikasi";
            }
            elseif($row->pengecekan == -1)
            {
                $verifikasi = "Ditolak";
            }
            else
            {
                $verifikasi = "Belum Verifikasi";
            }
            if($row->file == NULL){
                $file = "Belum Upload";
            }
            elseif($row->file != NULL){
                $file = "Sudah Upload";
            }

            $table.= "<tr>
            <td style='$data_css'>$no</td>
            <td style='$data_css'>$row->name</td>
            <td style='$data_css'>$row->nama_surat</td>
            <td style='$data_css'>$row->namajenis</td>
            <td style='$data_css'>$row->no_surat</td>
            <td style='$data_css'>$row->tanggal</td>
            <td style='$data_css'>$row->nama_pengupload</td>
            <td style='$data_css'>$file</td>
            <td style='$data_css'>$verifikasi</td>
            </tr>";

            $no++;
        }
        $table.= '</table>';

        header ("Content-type: application/xls;charset=UTF-8");
        header ("Content-Disposition: attachment; filename=SuratBelumUpload.xls" );
        return $table;
    }
