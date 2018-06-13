<?php
function hasMatched($string)
{
    $len = strlen($string);
    $stack = [];

    for ($i = 0; $i < $len; $i++) {
        switch ($string[$i]) {
            case '(':
                array_push($stack, 0);
                break;
            case ')':
                if (array_pop($stack) !== 0)
                    return false;
                break;
            case '[':
                array_push($stack, 1);
                break;
            case ']':
                if (array_pop($stack) !== 1)
                    return false;
                break;
            case '{':
                array_push($stack, 2);
                break;
            case '}':
                if (array_pop($stack) !== 2)
                    return false;
                break;
        }
    }
    return (empty($stack));
}

$a = '(){}[]'; //is valid
$b = '[{()}](){}'; // is valid
$c = '[]{()'; // is not valid
$d = '[{)]'; // is not valid

?>
<h1>Balanced Brackets</h1>
<p><?= $a ?> = <?= hasMatched($a) ? 'is valid' : 'is not valid'; ?></p>
<p><?= $b ?> = <?= hasMatched($b) ? 'is valid' : 'is not valid'; ?></p>
<p><?= $c ?> = <?= hasMatched($c) ? 'is valid' : 'is not valid'; ?></p>
<p><?= $d ?> = <?= hasMatched($d) ? 'is valid' : 'is not valid'; ?></p>

<form method="post">
    
    <label>Insert yout Brackets combination</label>
    <input type="text" value="<?= isset($_POST['text']) ? $_POST['text'] : null ?>" name="text">

    <button type="submit">Send</button>

    <?php if(isset($_POST['text'])) : ?>
        <?= hasMatched($_POST['text']) ? 'is valid' : 'is not valid'; ?>
    <?php endif ?>

</form>