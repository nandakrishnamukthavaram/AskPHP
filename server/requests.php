<?php
session_start();
include("../common/db.php");
if (isset($_POST['signup'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];

    $user = $conn->prepare("Insert into `users`
(`id`,`username`,`email`,`password`,`address`)
values(NULL,'$username','$email','$password','$address');
");

    $result = $user->execute();
    $user->insert_id;
    if ($result) {

        $_SESSION["user"] = ["username" => $username, "email" => $email, "user_id" => $user->insert_id];
        header("location: /askPHP");
    } else {
        echo "New user not registered";
    }

} else if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $username = "";
    $user_id = 0;

    $query = "select * from users where email='$email' and password='$password'";
    $result = $conn->query($query);
    if ($result->num_rows == 1) {

        foreach ($result as $row) {

            $username = $row['username'];
            $user_id = $row['id'];
        }

        $_SESSION["user"] = ["username" => $username, "email" => $email, "user_id" => $user_id];
        header("location: /askPHP");
    } else {
        echo "New user not registered";
    }

} else if (isset($_GET['logout'])) {
    session_unset();
    header("location: /askPHP");
} else if (isset($_POST["ask"])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $category_id = $_POST['category'];
    $user_id = $_SESSION['user']['user_id'];

    $question = $conn->prepare("Insert into `questions`
(`id`,`title`,`description`,`category_id`,`user_id`)
values(NULL,'$title','$description','$category_id','$user_id');
");

    $result = $question->execute();
    $question->insert_id;
    if ($result) {
        header("location: /askPHP");
    } else {
        echo "Question is added to website";
    }

}else if (isset($_POST["answer"])) {
    try {
        
        
        $answer = $_POST['answer'];
        $question_id = $_POST['question_id'];
        $user_id = $_SESSION['user']['user_id'];
        
        // Prepare the SQL statement
        $query = $conn->prepare("INSERT INTO `answers` (`answer`, `question_id`, `user_id`) VALUES (?, ?, ?)");
        
        // Bind parameters (s for string, i for integer)
        $query->bind_param("sii", $answer, $question_id, $user_id);
        
        // Execute the statement
        $result = $query->execute();
        
        if ($result) {
            header("Location: /askPHP?q-id=$question_id");
            exit(); // It's a good practice to call exit after a header redirect
        } else {
            echo "Answer is not submitted";
        }
    } catch (\Throwable $th) {
        die($th);
    }
}
else if (isset($_GET["delete"])) {
    echo $qid= $_GET["delete"];
     $queryQuestion= $conn->prepare("delete from questions where id =$qid");
     $queryAnswers= $conn->prepare("delete from answers where question_id =$qid");
     $result = $queryQuestion->execute() && $queryAnswers->execute();
     if($result){
        header("location: /askPHP");
     }else {
        echo "Question not deleted";
     }
}
?>