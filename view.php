<?php
  require_once 'core/core.php';
    include 'includes/header.php';
    include 'includes/navigation.php';

    if(isset($_GET['view']) && !empty($_GET['view'])){
        $toViewID = $_GET['view'];
        $sql = "SELECT * FROM events WHERE id = '$toViewID' ";
        $result = $db->query($sql);
        $row = mysqli_fetch_assoc($result);
    } else {
        header("Location: events.php");
    }
?>

<div class="container">

    <div class="page-header text-center">
        <h3><?php echo $row['event_topic']; ?></h3>
    </div>
    <div class="row">
        <div class="col-md-4">
            <figure>
                <img src="<?=$row['image'];?>" style="width:100%; padding-top:22px; height:370px" class="img-responsive img-thumb" alt="eventImg">
            </figure>
        </div>
        <div class="col-md-8">
            <div class="">
                <h3>Event Details:</h3>
                <hr>
            </div>
            <section class="text-justify">
                <?=$row['full_details']; ?>
            </section>
            <hr>
            <p><b>DATE  :</b> <?=$row['date'];?></p>
            <p><b>TIME  :</b> <?=$row['time'];?></p>
            <p><b>VENUE :</b> <?=$row['venue'];?></p>
            <p>
                <a href="events.php" class="btn btn-md btn-primary"><span class="glyphicon glyphicon-backward"></span> Back to events</a>
            </p>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
<script src="js/jquery-1.11.2.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
