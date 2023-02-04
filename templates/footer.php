<?php
include_once("./database/config.php");
?>
<footer class="bg-dark default-padding-top text-light" style="padding-bottom:90px;">
    <div class="container">
        <div class="row">
            <div class="f-items">
                <div class="col-md-4 item">
                    <div class="f-item">
                        <img src="assets/img/logo-light.png" alt="Logo">
                        <p>
                            Sikkha is an e-learning platform based in Bangladesh that provides access to a wealth of
                            knowledge for local students and professionals. With Sikkha, you can gain the skills and
                            knowledge you need to succeed in today's world.
                        </p>
                        <div class="social">
                            <ul>
                                <li>
                                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fab fa-google-plus-g"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fab fa-dribbble"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-sm-6 item">
                    <div class="f-item link">
                        <h4>Links</h4>
                        <ul>
                            <li>
                                <a href="#">Courses</a>
                            </li>
                            <li>
                                <a href="#">Event</a>
                            </li>
                            <li>
                                <a href="#">Gallery</a>
                            </li>
                            <li>
                                <a href="#">Faqs</a>
                            </li>
                            <li>
                                <a href="#">Teachers</a>
                            </li>
                            <li>
                                <a href="#">Contact</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2 col-sm-6 item">
                    <div class="f-item link">
                        <h4>Support</h4>
                        <ul>
                            <li>
                                <a href="#">Documentation</a>
                            </li>
                            <li>
                                <a href="#">Forums</a>
                            </li>
                            <li>
                                <a href="#">Language Packs</a>
                            </li>
                            <li>
                                <a href="#">Release Status</a>
                            </li>
                            <li>
                                <a href="#">LearnPress</a>
                            </li>
                            <li>
                                <a href="#">Feedback</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 item">
                    <div class="f-item recent-post">
                        <h4>Popular Courses</h4>
                        <ul>
                            <?php
                            $sql = "SELECT * FROM courses order by rand() limit 3";
                            $result = mysqli_query($conn, $sql);
                            if($result){
                                while($row=mysqli_fetch_assoc($result)){
                                $course_img=$row['course_img'];
                                $course_name=$row['course_name'];
                                $teacher_id=$row['teacher_id'];

                                $sql2 = "SELECT * FROM teachers where teacher_id= $teacher_id";
                                    $result2 = mysqli_query($conn, $sql2);
                                    $row2=mysqli_fetch_assoc($result2);

                                    $teacher_name=$row2['firstname']. " ". $row2['lastname'];
                            ?>
                            <li>
                                <div class="thumb">
                                    <a href="#">
                                        <img src="assets/img/courses/<?php echo $course_img?>" alt="Thumb">
                                    </a>
                                </div>
                                <div class="info">
                                    <a href="#"><?php echo $course_name?></a>
                                    <div class="meta-title">
                                        <span class="post-date"></span> - By <a href="#"><?php echo $teacher_name?></a>
                                    </div>
                                </div>
                            </li>
                            
                            <?php
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>