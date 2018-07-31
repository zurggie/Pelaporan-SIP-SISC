<style>
    .backwhite {
        background-color:white;
    }
    .mtb {
        margin-top:1rem;
        margin-bottom:1rem;
    }
    .mypanel {
        margin-top: 2rem;
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        transition: 0.3s;
        border-radius: 5px; /* 5px rounded corners */
    }
    .mypanel-body {
        padding: 2px 16px;
    }
    .std1 table,
    .std1 th,
    .std1 td {
        border: 1px solid black;
    }
    .std1 th {
        text-align: center;
    }
</style>

<div class="col-xs-12 backwhite">
    <div class="container">
        <div class="row mtb">
            <div class="col-xs-8">
                <select class="form-control">
                    <option>Sila Pilih PGB...</option>
                    <option>NAMA 1</option>
                    <option>NAMA 2</option>
                </select>
            </div>
            <div class="col-xs-2">
                <button type="submit" class="btn btn-primary btn-block">RUMUSAN</button>
            </div>
            <div class="col-xs-2">
                <button type="submit" class="btn btn-success btn-block">CARTA</button>
            </div>
        </div>
        <div class="row mtb">
            <div class="col-xs-12">
                <div class="mypanel">
                    <div class="mypanel-body">
                        <!-- ============ START RUMUSAN & GRAF PAGE ============== -->
                        <?php  
                            if($_GET['inpage']=='rumusan') {
                                include 'rumusan.php';
                            } elseif ($_GET['inpage'] == 'carta') {
                                include 'carta.php';
                            } else {
                                echo 'TIADA';
                            }
                        ?>
                        <!-- ============ START RUMUSAN & GRAF PAGE ============== -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>