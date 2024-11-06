<div class="container">
    <div class="offset-sm-1">
<h5>Answers:</h5>
<?php 
$query="select * from answers where question_id=$qid";
$result= $conn->query($query);
foreach ($result as $row) {
    $answer = $row['answer'];
    $uid = $row['user_id'];
    $query2="select * from users where id=$uid";
    $user = $conn->query($query2);
    $userdetails;
    foreach ($user as $rows) {
        $userdetails = $rows['id'];
    }
    $userName = $user['id'];
    echo "<div class='row'>
    <p class='answer-wrapper'>$answer</p>
    <span>$userName</span>
    </div>";
}
?>
</div>
</div>