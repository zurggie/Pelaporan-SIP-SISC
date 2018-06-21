
<?php

	@require_once("../modul/session.php");
	require_once("../modul/class.user.php");
	$auth_user = new USER();

	
	$user_id = $_SESSION['user_session'];
	
	$stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
	$stmt->execute(array(":user_id"=>$user_id));
	
	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
    $tingkatan=$userRow['tingkatan'];
    $namapengguna=$userRow['user_name'];
    $kelas=$userRow['kelas'];
    $namapenuh=$userRow['real_name'];
    $kodsekolah=$userRow['kodsekolah'];
    $kodppd=$userRow['kodppd'];
    $kodnegeri=$userRow['kodnegeri'];
    $userlevel=$userRow['userlevel'];



    $sqln = $auth_user->runQuery("SELECT * FROM tkppd  WHERE KODPPD=:kodppd");
	$sqln->execute(array(":kodppd"=>$kodppd));
    $sqlnRow=$sqln->fetch(PDO::FETCH_ASSOC);
    $namappd=$sqlnRow['NAMAPPD'];



 @$id= $_GET['id'];
?>



<?php



$sql = "SELECT
users.user_name,
users.real_name,
sisc_guru.SISC,
sisc_guru.NOKP,sisc_guru.ID,
sisc_guru.NAMAGURU,
sisc_guru.KODSEKOLAH,
sisc_guru.JAWATAN,
sisc_guru.KODPPD,
sisc_guru.TAHUN,
tssekolah.NAMASEKOLAH
FROM
users
JOIN sisc_guru
ON users.user_name = sisc_guru.SISC 
JOIN tssekolah
ON sisc_guru.kodsekolah = tssekolah.KODSEKOLAH


WHERE sisc_guru.SISC=:namapengguna  ORDER BY sisc_guru.NAMAGURU ASC";
	
$result = $auth_user->runQuery($sql);
$result->bindParam(':namapengguna', $namapengguna);	
$result->execute();
      
      

    
      
      
  
            
$bil=0;
if ($result->rowCount() > 0) {		
foreach ($result as $have_rows) {

                        $id=$have_rows['ID'];
                        $nama=$have_rows['NAMAGURU'];
                        $nokp=$have_rows['NOKP'];
                        $namasekolah=$have_rows['NAMASEKOLAH'];
                       
    
           
                        $bil++;
    





//if( $have_rows('NAMAGURU') ): ?>
	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
		<?php $i=1; while ( have_rows('faqs') ) : the_row(); ?>
			<div class="panel panel-default">
			    <div class="panel-heading" role="tab" id="heading-<?php echo $i; ?>">
			      <h2 class="panel-title">
			        <a data-toggle="collapse" data-parent="#accordion" href="#collapse-<?php echo $i; ?>" aria-expanded="true" aria-controls="collapseOne">
			         <?php the_sub_field('question'); ?>
			        </a>
			      </h2>
			    </div>
			    <div id="collapse-<?php echo $i; ?>" class="panel-collapse collapse <?php if ($i==1) { echo 'in'; } ?>" role="tabpanel" aria-labelledby="heading-<?php echo $i; ?>">
			      <div class="panel-body">
			       	<?php the_sub_field('answer'); ?>
			      </div>
			    </div>
			</div>
		<?php $i++; endwhile; ?>
	</div>
<?php // endif; 

}
}
 