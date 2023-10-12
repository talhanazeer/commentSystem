<?php
// Check if the form was submitted
include_once 'connection.php';

function fetchReplies($cmtID, $mysqli) {
    $rquery = "SELECT * FROM `comments` WHERE parent_id = $cmtID";
    $rcomments = $mysqli->query($rquery);
    
    $html = '';

    while ($rcmt = $rcomments->fetch_assoc()) {
        $html .= '<div class="comment mt-4" data-parent="' . $rcmt['id'] . '">';
        $html .= '<span class="author">' . $rcmt['AuthorName'] . '</span>';
        $html .= '<span class="timestamp">' . timetohr($rcmt['CommentDate']) . '</span>';
        $html .= '<p>' . $rcmt['CommentText'] . '</p>';
        $html .= '<button class="reply-button">Reply</button>';
        $html .= fetchReplies($rcmt['id'], $mysqli); // Recursively fetch replies
        $html .= '</div>';
    }

    return $html;
}

function timetohr($time) {
    $commentDate = strtotime($time);
    $currentTime = time();
    $timeDiff = $currentTime - $commentDate;
    $hours = floor($timeDiff / 3600);
    $minutes = floor(($timeDiff % 3600) / 60);
    $seconds = $timeDiff % 60;
    $timeAgo = '';

    if ($hours > 0) {
        $timeAgo .= $hours . " hours ";
    }
    if ($minutes > 0) {
        $timeAgo .= $minutes . " minutes ";
    }
    if ($seconds > 0) {
        $timeAgo .= $seconds . " seconds";
    }

    return $timeAgo;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    if ($_POST['submit'] == 'comment') {
        // Retrieve form data
        $authorName = $_POST["Name"];
        $authorEmail = $_POST["Email"];
        $commentText = $_POST["Message"];
        $commentid = $_POST["Parent_id"];
        $commentSid = $_POST["Start_id"];

        $sql = "INSERT INTO `comments`(`start_id`, `parent_id`, `AuthorName`, `AuthorEmail`, `CommentText`, `CommentDate`) VALUES ($commentSid, $commentid, '$authorName', '$authorEmail', '$commentText', NOW())";

        if ($mysqli->query($sql)) {
            echo "Comment submitted successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
    }
} else {
    // Redirect to the comment submission form if the form was not submitted
    header("/");
}
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        /* Basic styling for comments and replies */
        .comment,
        .reply-form {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
            box-sizing: border-box;
        }

        .reply-form {
            display: none;
        }

        .reply {
            border: 1px solid #ddd;
            padding: 10px;
            margin-left: 20px;
        }

        /* Styling for author name and timestamp */
        .author {
            font-weight: bold;
        }

        .timestamp {
            font-size: 0.8em;
            color: #666;
        }

        /* Styling for the reply button */
        .reply-button,
        .cmt,
        .rreply-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }

        /* Styling for the input field and submit button for new replies */
        .reply-input {
            width: 100%;
            padding: 5px;
            margin: 5px 0;
            box-sizing: border-box;
        }

        .submit-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }

        .mt-4 {
            margin-top: 35px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <!-- Comment Section -->
                <button class="cmt">Comment</button>
                <?php
                $query = "SELECT * FROM `comments` WHERE parent_id=0";
                $comments = $mysqli->query($query);

                if ($comments->num_rows > 0) {
                    while ($cmt = $comments->fetch_assoc()) {
                ?>
                        <div class="comment first" data-parent='<?php echo $cmt['id'] ?>' data-start='<?php echo $cmt['id'] ?>'>
                            <span class="author"><?php echo $cmt['AuthorName'] ?></span>
                            <span class="timestamp"><?php echo timetohr($cmt['CommentDate']) ?></span>
                            <p><?php echo $cmt['CommentText'] ?></p>
                            <button class="reply-button">Reply</button>
                            <?php echo fetchReplies($cmt['id'], $mysqli); ?>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
            <div class="col-lg-6">
                <div class="reply-form">
                    <!-- Reply Form -->
                    <form class="mt-4" method="post">
                        <input class="reply-input" type="text" name="Name" placeholder="Name" required>
                        <input class="reply-input" type="text" name="Email" placeholder="Email" required>
                        <input class="reply-Pid" type="hidden" name="Parent_id" value="0">
                        <input class="reply-Sid" type="hidden" name="Start_id" value="0">
                        <textarea rows='5' class="reply-input" name="Message" type="text" placeholder="Write a reply..." required></textarea>
                        <button class="submit-button" type="submit" name="submit" value="comment">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Add more comments and replies as needed -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function () {
            $('.reply-button').on("click", function () {
                $('.reply-form').css('display', 'block');
                var id = $(this).parents('.comment').data('parent');
                var sid = $(this).parents('.comment.first').data('start');
                $('.reply-Pid').val(id);
                $('.reply-Sid').val(sid);
            });
            $('.cmt').on("click", function () {
                $('.reply-form').css('display', 'block');
            });
        });
    </script>
</body>

</html>
