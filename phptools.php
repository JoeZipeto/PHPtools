<?php
require_once('php/customLinkedList.class.php');

// Functions defined here
function printWithSpaces($str)
{
    if (strlen($str) == 0) {
        return;
    } else {
        echo substr($str, 0, 1) . " ";
        $str = substr($str, 1, strlen($str));
        printWithSpaces($str);
    }
}

function weave($str1, $str2)
{
    if (strlen($str1) === 0 || strlen($str2) === 0) {
        return $str1 . $str2;
    }
    return substr($str1, 0, 1) . substr($str2, 0, 1) .
    weave(substr($str1, 1, strlen($str1)),
        substr($str2, 1, strlen($str2)));

}

function printAsterisk($start, $end)
{
    if ($start <= $end) {
        for ($i = 0; $i < $end; $i++) {
            echo "*";
        }
        echo '<br>';
        printAsterisk($start + 1, $start);
        for ($i = $start; $i > 0; $i--) {
            echo "*";
        }
        echo '<br>';
    }
}

function checkUserInput($id, $default)
{
    return empty($_POST[$id]) ? $default : $_POST[$id];
}

//Object for linked list define here
//$newList = new customLinkedList();
//for ($i = 0; $i < 10; $i++) {
//    $newList->insert($i);
//}
//  These define default values for the textbox's
$arrayTextbox = array(
    'spacesInput' => 'Space',
    'weaveInput' => 'ACEG',
    'weaveSecondInput' => 'BDFH',
    'printAsteriskStart' => "3",
    'printAsteriskEnd' => "5");

$str = isset($str) || $str = '';
$strWeave = isset($strWeave) || $strWeave = '';
$strAfter = isset($strAfter) || $strAfter = '';
$start = isset($start) || $start = "1";
$end = isset($end) || $end = "5";
$newList = new customLinkedList(null);

// loops to run function with array which sets the default values
foreach ($arrayTextbox as $key => $value) {
    checkUserInput($key, $value);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title> PHP Tools </title>
    <link rel="stylesheet" type="text/css" href='css/bootstrap.min.css'>
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <script src=New%20folder/jquery-1.12.3.js type="text/javascript"></script>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <h1 class="page-header"> PHP Tools </h1>
    </div>
    <div class="container-fluid">
        <!-- form for Print with spaces -->
        <form class="col-sm-12" method="post" action="phptools.php">
            <fieldset class="jumbotron">
                <legend> Prints with spaces</legend>
                <img class="col-sm-4 img-responsive" src="img/printWithSpaces.png"
                     alt="Code for the print with spaces">
                <div class="col-sm-6">
                    <label for="spacesInput">Enter a Value:</label>
                    <input type="text" name="spacesInput"
                           id="spacesInput"
                           value="<?php echo htmlentities(checkUserInput('spacesInput', 'Space')) ?>">
                    <br><label for="outputSpaces">Output: </label>
                    <?php
                    if (isset($_POST['submitSpace'])) {
                        $str = empty($_POST['spacesInput'])
                            ? "Space" : $_POST['spacesInput'];
                    }
                    ?>
                    <input type="text" id="outputSpaces"
                           value="<?php htmlentities(printWithSpaces($str)) ?>">
                    <input class="btn-primary" type="submit" name="submitSpace">

                    <br>
                </div>
                <p class="extraMargin"><b>Description: </b> Using Recursion to place Spaces inBetween the
                    charactors you type in the textbox. If you press the submit button without typing in a
                    value the default has been set to "Space". </p>
            </fieldset>
        </form>
        <br>

        <!-- form for weave two strings -->
        <form class="col-sm-12" method="post" action="phptools.php">
            <fieldset class="jumbotron">
                <legend> Weave two Strings</legend>
                <div class="container-fluid">
                    <div class="row">
                        <img class="col-sm-4 img-responsive" src="img/weave.png" alt="Code for Weave">
                        <div class="col-sm-6">
                            <label for="weaveInput">Enter a String:</label>
                            <input type="text" name="weaveInput" id="weaveInput"
                                   value="<?php echo htmlentities(checkUserInput('weaveInput', 'ACEG')) ?>"><br>
                            <label for="weaveSecondInput"> Enter a String:</label>
                            <input type="text" name="weaveSecondInput" id="weaveSecondInput"
                                   value="<?php echo htmlentities(checkUserInput('weaveSecondInput', 'BDFH')) ?>"><br>
                            <?php
                            if (isset($_POST['submitWeave'])) {
                                $str1 = empty($_POST['weaveInput']) ? "ACEG" : $_POST['weaveInput'];
                                $str2 = empty($_POST['weaveSecondInput']) ? "BDFH" : $_POST['weaveSecondInput'];
                                $strWeave = weave($str1, $str2);
                            }
                            ?>
                            <label for="weaveOutput">Output:</label>
                            <input type="text"
                                   id="weaveOutput"
                                   value="<?php echo htmlentities($strWeave) ?>">
                            <input class="btn-primary" type="submit" name="submitWeave">
                        </div>
                    </div>
                    <p><b>Description:</b>I used Recursion here as well to weave the two string together.
                        The Default for the string one is ACEG and String 2 is BDFH.</p>

            </fieldset>
        </form>

        <br>

        <!--  form for printing asterisk-->
        <form method="post" class="col-sm-12" action="phptools.php">
            <fieldset class="jumbotron">
                <div class="container-fluid">
                    <div class="row">
                        <legend><h3> Print Asterisk</h3></legend>
                        <img class="col-sm-4" src="img/printAsterisk.png" alt="Code for Print with Asterisk">
                        <div class="col-sm-4">
                            <label for="printAsteriskStart">Start:</label>
                            <input type="text" name="printAsteriskStart"
                                   id="printAsteriskStart"
                                   value="<?php echo $start ?>">

                            <label for="printAsteriskEnd">End:</label>
                            <input type="text" name="printAsteriskEnd"
                                   id="printAsteriskEnd"
                                   value="<?php echo $end ?>">
                            <input class="btn-primary" type="submit" name="submitAsterisk">
                        </div>
                        <div class="col-sm-3">
                            <?php
                            if (isset($_POST['submitAsterisk'])) {
                                $start = empty($_POST['printAsteriskStart']) ? 3 : $_POST['printAsteriskStart'];
                                $end = empty($_POST['printAsteriskEnd']) ? 5 : $_POST['printAsteriskEnd'];
                                $valid = true;

                                if (!is_numeric($start)) {
                                    echo '<div class="alert alert-danger"> Start must be a number</div>';
                                    $valid = false;
                                } else if (!is_numeric($end)) {
                                    echo '<div class="alert alert-danger"> End Must Be a number</div>';
                                    $valid = false;
                                } else if ($start > $end) {
                                    echo '<div class="alert alert-danger"> Start cannot be greater than End</div>';
                                    $valid = false;
                                }
                                if ($valid)
                                    printAsterisk($start, $end);
                            }
                            ?>
                        </div>
                    </div>
                    <p><b>Description: </b> Using Recursion to print out * to the screen. This will depend on
                        the Start/Finish you provide. Default is start = 3 and end = 5. Rules are that
                        you have to enter numbers only and start cannot be greater than start.
                    </p>
                </div>
            </fieldset>
        </form>

        <br>

        <!-- form for Linked List -->
        <form class="col-sm-12">
            <fieldset class="jumbotron">
                <div class="container-fluid">
                    <div class="row">
                        <legend>Linked List</legend>
                        <div class="col-sm-8">
                            <label for="addLink">Add</label><input type="text" name="addLink" id="addLink">
                            <button class="btn btn-primary button" type="button"
                                    name="addLink" value="add">Add
                            </button>

                            <label for="showValues"> Node values in linked list are</label>
                            <input id="showValues" type="text" disabled><br>

                            <label for="findValue"> Find value:</label>
                            <input id="findValue" type="text">
                            <button id="find" class="btn btn-primary button" type="submit"
                                    value="find"> Find
                            </button>
                            <input type="text" value="" disabled>
                            <br>

                            <label for="currentNodeValue">
                                Value of Current Node is</label>
                            <input id="currentNodeValue" type="text" disabled><br>


                            <label for="sizeOfList"> Size of LinkedList is</label>
                            <input id="sizeOfList" type="text" disabled><br>

                            <label for="removeNode"> Remove data</label>
                            <input id="removeNode" type="text" disabled>
                            <button id="remove" class="btn btn-primary button" type="submit"
                                    value="remove"> Remove
                            </button>
                            <input type="text" value="" disabled><br>
                        </div>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>

<script>
    $(document).ready(function () {
        $(".button").click(function (e) {
            e.preventDefault();
            var data = {
                'action': $(this).val(),
                'add': $("#addLink").val(),
                'find': $("#findValue").val(),
                'remove': $("#removeNode").val()
            };
            $.post('php/ajax.php', data, function (returnData) {
                var temp = $(returnData);
                console.log(temp);
                alert("Data Loaded: " + temp);
            });
        });
    });
</script>
</body>
</html>