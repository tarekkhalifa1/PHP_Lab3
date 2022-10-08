<!-- Start PHP code -->
<?php

$show_data = false;

if (isset($_POST['submit'])) {
    // print_r($_POST);die;

    $form_errors = [];
    // get form fields
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    if (isset($_POST['group'])) {
        $group = $_POST['group'];
    }
    if (isset($_POST['details'])) {
        $details = $_POST['details'];
    }
    if (isset($_POST['gender'])) {
        $gender = $_POST['gender'];
    }
    if (isset($_POST['courses'])) {
        $courses = $_POST['courses'];
    }


    // First validation check on fields key and empty values:

    if (!isset($first_name) || empty($first_name)) {
        $form_errors['first_name_field'] = "<div> First name required </div>";
    } // first name field

    if (!isset($last_name) || empty($last_name)) {
        $form_errors['last_name_field'] = "<div> Last name required </div>";
    } // last name field

    if (!isset($email) || empty($email)) {
        $form_errors['email_field'] = "<div> Email required </div>";
    } // email field

    if (!isset($group)) {
        $form_errors['group_field'] = "<div>Invalid field</div>";
    } // check on group key only values is optional

    if (!isset($details)) {
        $form_errors['details_field'] = "<div>Invalid field</div>";
    } // check on details key only key values is optional

    if (!isset($_POST['gender']) || empty($_POST['gender'])) {
        $form_errors['gender_field'] = "<div>Gender required</div>";
    } // gender field

    if (!isset($courses) || empty($courses)) {
        $form_errors['courses_field'] = "<div>Please select at least one course</div>";
    } // courses field


    // Second validation check on inputs regex:

    if (empty($form_errors)) {
        $name_regex = "/^([a-zA-Z ]){3,30}$/";
        $email_regex = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";
        $our_courses = ["PHP", "JavaScript", "MySQL", "HTML"];

        if (!preg_match($name_regex, $first_name)) {
            $form_errors['first_name_field'] = "<div>Invalid name</div>";
        } // first name regex validate

        if (!preg_match($name_regex, $last_name)) {
            $form_errors['last_name_field'] = "<div>Invalid name</div>";
        } // last name regex validate


        if (!preg_match($email_regex, $email)) {
            $form_errors['email_field'] = "<div>Invalid email</div>";
        } // email regex validate

        if ($gender !== "m" && $gender !== "f") {
            $form_errors['gender_field'] = "<div>Invalid gender</div>";
        } // gender value validate

        for ($i = 0; $i < count($courses); $i++) {
            if (!in_array($courses[$i], $our_courses)) {
                $form_errors['courses_field'] = "<div>Please select at least one from theses courses</div>";
            }
        } // course value validate


    } // end of second validation

    // final show application data to user:

    if (empty($form_errors)) {
        $show_data = true; // display application to user

    } 

} // end of post submit 
?>

<!-- End PHP code -->

<!doctype html>
<html lang="en">

<head>
    <title>Application</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <style>
            <?php
            if ($show_data === true) {
                echo ".registeration {display: none;}";
            }
            ?>

        table {
            padding: 15px;
            font-size: 1.4rem;
        }
    </style>
</head>

<body>


    <!-- Register Content -->
    <section class="registeration">
        <div class="container">
            <div class="row">
                <div class="col-12 mt-1">
                    <div class="col-12 text-center text-uppercase">
                        <h2 class="text-primary my-3">Form Application</h2>
                    </div>
                </div>

                <main class="row">
                    <div id="registerErrors" class="col-lg-4 col-md-6 col-sm-8 mx-auto mb-4">
                        <div class="col-12">
                            <form id="registeration" method="POST" action="<?php $_PHP_SELF ?>">
                                <div class="mb-3">
                                    <label for="first_name" class="form-label">First Name</label> <span class="text-danger">*</span>
                                    <input type="text" name="first_name" id="first_name" class="form-control 
                                                <?php
                                                echo (isset($form_errors['first_name_field'])) ? "is-invalid" : "";
                                                ?>
                                            " value="<?php echo isset($first_name) ? $first_name : "" ?>">
                                    <div class="invalid-feedback">
                                        <?php
                                        echo (isset($form_errors['first_name_field'])) ? $form_errors['first_name_field'] : "";
                                        ?>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="last_name" class="form-label">Last Name</label> <span class="text-danger">*</span>
                                    <input type="text" name="last_name" id="last_name" class="form-control
                                        <?php
                                        echo (isset($form_errors['last_name_field'])) ? "is-invalid" : "";
                                        ?>
                                        " value="<?php echo isset($last_name) ? $last_name : "" ?>">

                                    <div class="invalid-feedback">
                                        <?php
                                        echo (isset($form_errors['last_name_field'])) ? $form_errors['last_name_field'] : "";
                                        ?>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label> <span class="text-danger">*</span>
                                    <input type="text" name="email" id="email" class="form-control
                                        <?php
                                        echo (isset($form_errors['email_field'])) ? "is-invalid" : "";
                                        ?>
                                        " value="<?php echo isset($email) ? $email : "" ?>">

                                    <div class="invalid-feedback">
                                        <?php
                                        echo (isset($form_errors['email_field'])) ? $form_errors['email_field'] : "";
                                        ?>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="group" class="form-label">Group #</label>
                                    <input type="text" name="group" id="group" class="form-control
                                    <?php
                                    echo (isset($form_errors['group_field'])) ? "is-invalid" : "";
                                    ?>
                                        " value="<?php echo isset($group) ? $group : "" ?>">
                                    <div class="invalid-feedback">
                                        <?php
                                        echo (isset($form_errors['group_field'])) ? $form_errors['group_field'] : "";
                                        ?>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="class-details" class="form-label">Class Details</label>
                                    <textarea name="details" id="class-details" rows="2" class="form-control 
                                    <?php
                                    echo (isset($form_errors['details_field'])) ? "is-invalid" : "";
                                    ?>
                                        "><?php echo isset($details) ? $details : "" ?></textarea>
                                    <div class="invalid-feedback">
                                        <?php
                                        echo (isset($form_errors['details_field'])) ? $form_errors['details_field'] : "";
                                        ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 d-flex">
                                        <label for="gender" class="form-label">Gender:</label> <span class="text-danger">*</span>
                                        <div class="form-check mx-3">
                                            <input class="form-check-input" type="radio" value="m" name="gender" id="male" <?php if (isset($gender) && $gender === "m") echo "checked" ?>>
                                            <label class="form-check-label" for="male">
                                                Male
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="f" name="gender" id="female" <?php if (isset($gender) && $gender === "f") echo "checked" ?>>
                                            <label class="form-check-label" for="female">
                                                Female
                                            </label>
                                        </div>
                                        <div class="text-sm text-danger ms-5">
                                            <?php
                                            echo (isset($form_errors['gender_field'])) ? $form_errors['gender_field'] : "";
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="gender" class="form-label">Select Courses:</label> <span class="text-danger">*</span>
                                    <select multiple name="courses[]" class="form-select 
                                    <?php
                                    echo (isset($form_errors['courses_field'])) ? "is-invalid" : "";
                                    ?>
                                    ">
                                        <option disabled>Select at least one</option>
                                        <option <?= isset($courses[0]) ? "selected" :  ""; ?> value="PHP">PHP</option>
                                        <option <?= isset($courses[1]) ? "selected" :  ""; ?> value="JavaScript">JavaScript</option>
                                        <option <?= isset($courses[2]) ? "selected" :  ""; ?> value="MySQL">MySQL</option>
                                        <option <?= isset($courses[3]) ? "selected" :  ""; ?> value="HTML">HTML</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?php
                                        echo (isset($form_errors['courses_field'])) ? $form_errors['courses_field'] : "";
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group mb-4">
                                    <button name="submit" id="submit" type="submit" class="btn btn-outline-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </main>
            </div>
        </div>
    </section>
    <!-- Register Content -->


    <?php
    if ($show_data == true) { // show application data
    ?>
        <!-- Application Content -->
        <section class="mt-5" id="application_data" style="height: 100h;">
            <div class="container">
                <h2 class="text-center mb-5">My Apllication</h2>
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Group</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Courses</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $first_name ?></td>
                            <td><?= $last_name ?></td>
                            <td><?= $email ?></td>
                            <td><?= $group ?></td>
                            <td>
                                <?php
                                if ($gender === "m") {
                                    echo "Male";
                                } else {
                                    echo "Female";
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if (count($courses) > 0) {
                                    echo implode(", ", $courses);
                                } else {
                                    echo $courses[0];
                                }
                                ?>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <a class="mt-5 btn btn-danger" href="index.php">New registeration</a>

            </div>
        </section>

    <!-- Application Content -->

    <?php
    } // end show application data
    ?>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>