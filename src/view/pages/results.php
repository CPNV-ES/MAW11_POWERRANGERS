<?php

//initialize page variables
$title = "Results";
$navTitle = "Exercise: <b>" . htmlspecialchars($exercise['name'], ENT_QUOTES, 'UTF-8') . "</b>";
$navColor = "green";
$styles = ["<link rel='stylesheet' href='/css/pages/fulfillments.css'>"];

ob_start();
?>
    <table class="table w-100">
        <thead>
        <tr>
            <th scope="col" >Take</th>
            <?php foreach ($fields as $field) : ?>
                <th scope="col"><a class="icon text-decoration-none " href="/exercises/<?= $this->variables['exerciseId'] ?>/results/<?= $field->id ?>"><?= $field->name ?></a></th>
            <?php endforeach; ?>
        </tr>
        </thead>

        <tbody>
        <?php foreach ($fulfillments as $fulfillment) : ?>
        <tr>

                <?php foreach ($formattedAnswer as $item) :?>
                    <?php if (strlen($item) == 0) : ?>
                    <td class="svg" class="icon" >
                        <svg width="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M6.99486 7.00636C6.60433 7.39689 6.60433 8.03005 6.99486 8.42058L10.58 12.0057L6.99486 15.5909C6.60433 15.9814 6.60433 16.6146 6.99486 17.0051C7.38538 17.3956 8.01855 17.3956 8.40907 17.0051L11.9942 13.4199L15.5794 17.0051C15.9699 17.3956 16.6031 17.3956 16.9936 17.0051C17.3841 16.6146 17.3841 15.9814 16.9936 15.5909L13.4084 12.0057L16.9936 8.42059C17.3841 8.03007 17.3841 7.3969 16.9936 7.00638C16.603 6.61585 15.9699 6.61585 15.5794 7.00638L11.9942 10.5915L8.40907 7.00636C8.01855 6.61584 7.38538 6.61584 6.99486 7.00636Z" fill="#ee5d5d"></path> </g></svg>
                    </td>
                    <?php elseif (strlen($item) >= 10) : ?>
                    <td>
                        <svg width="26px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M4 12.6111L8.92308 17.5L20 6.5" stroke="#419d78" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                    </td>
                    <?php else : ?>
                    <td>
                        <svg width="26px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g id="Interface / Check_All_Big"> <path id="Vector" d="M7 12L11.9497 16.9497L22.5572 6.34326M2.0498 12.0503L6.99955 17M17.606 6.39355L12.3027 11.6969" stroke="#419d78" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g> </g></svg>
                    </td>
                    <?php endif;?>
                <?php endforeach ?>

            <td class="take"><a href="/exercises/<?= $this->variables['exerciseId'] ?>/fulfillments/<?= $fulfillment->fulfillment_id ?>"><?= $fulfillment->dateTime . " UTC"; ?></a></td>
            <?php foreach ($answers as $answer) :?>
                <?php foreach ($answer as $item) :?>
                    <?php if (strlen($item->value) == 0 && $item->fulfillment_id == $fulfillment->fulfillment_id) : ?>
                        <td class="svg" class="icon" >
                            <svg width="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M6.99486 7.00636C6.60433 7.39689 6.60433 8.03005 6.99486 8.42058L10.58 12.0057L6.99486 15.5909C6.60433 15.9814 6.60433 16.6146 6.99486 17.0051C7.38538 17.3956 8.01855 17.3956 8.40907 17.0051L11.9942 13.4199L15.5794 17.0051C15.9699 17.3956 16.6031 17.3956 16.9936 17.0051C17.3841 16.6146 17.3841 15.9814 16.9936 15.5909L13.4084 12.0057L16.9936 8.42059C17.3841 8.03007 17.3841 7.3969 16.9936 7.00638C16.603 6.61585 15.9699 6.61585 15.5794 7.00638L11.9942 10.5915L8.40907 7.00636C8.01855 6.61584 7.38538 6.61584 6.99486 7.00636Z" fill="#ee5d5d"></path> </g></svg>
                        </td>
                    <?php elseif (strlen($item->value) >= 10 && $item->fulfillment_id == $fulfillment->fulfillment_id) : ?>
                        <td>
                            <svg width="26px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g id="Interface / Check_All_Big"> <path id="Vector" d="M7 12L11.9497 16.9497L22.5572 6.34326M2.0498 12.0503L6.99955 17M17.606 6.39355L12.3027 11.6969" stroke="#419d78" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g> </g></svg>
                        </td>
                    <?php elseif ($item->fulfillment_id == $fulfillment->fulfillment_id) : ?>
                        <td>
                            <svg width="26px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M4 12.6111L8.92308 17.5L20 6.5" stroke="#419d78" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                        </td>
                    <?php endif;?>
                <?php endforeach ?>
            <?php endforeach ?>
        </tr>
        <?php endforeach;?>
        </tbody>
    </table>



<?php

$content = ob_get_clean();

//load layout
require __DIR__ . "/../layout.php";
