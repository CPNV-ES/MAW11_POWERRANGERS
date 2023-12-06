<?php

//initialize page variables
$title = "Manage exercises";
$navColor = "green";
$styles = array("<link rel='stylesheet' href='/css/pages/manage.css'>");

ob_start();
?>


    <div class="container">
        <div class="row">

            <div class="col">
                <div class="row"><h1 class="col-header">Building</h1></div>
                <div class="row">
                    <table>
                        <tr>
                            <th>Title</th>
                        </tr>
                        <tr>
                            <td class="text-section">Mon exo de fou malade c'est t asc  asd asd asd rop styasdasdle asdah askdj</td>
                            <td class="icon-section">
                                    <i class="fa-solid fa-comment"></i>
                                    <i class="fa-solid fa-pen-to-square"></i>
                                    <i class="fa-solid fa-trash"></i>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-section">Mon exo</td>
                            <td class="icon-section">
                                <i class="fa-solid fa-comment"></i>
                                <i class="fa-solid fa-pen-to-square"></i>
                                <i class="fa-solid fa-trash"></i>
                            </td>
                        </tr><tr>
                            <td class="text-section">Mon exo</td>
                            <td class="icon-section">
                                <i class="fa-solid fa-comment"></i>
                                <i class="fa-solid fa-pen-to-square"></i>
                                <i class="fa-solid fa-trash"></i>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col">

                <div class="row"><h1 class="col-header">Answering</h1></div>
                <div class="row">
                    <table>
                        <tr>
                            <th>Title</th>
                        </tr>
                        <tr>
                            <td class="text-section">Mon exo de fou malade c'est t asc  asd asd asd rop styasdasdle asdah askdj</td>
                            <td class="icon-section">
                                <i class="fa-solid fa-chart-column"></i>
                                <i class="fa-solid fa-circle-minus"></i>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-section">Mon exo</td>
                            <td class="icon-section">
                                <i class="fa-solid fa-chart-column"></i>
                                <i class="fa-solid fa-circle-minus"></i>
                            </td>
                        </tr><tr>
                            <td class="text-section">Mon exo</td>
                            <td class="icon-section">
                                <i class="fa-solid fa-chart-column"></i>
                                <i class="fa-solid fa-circle-minus"></i>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="col">
                <div class="row"><h1 class="col-header">Closed</h1></div>
                <div class="row">
                    <table>
                        <tr>
                            <th>Title</th>
                        </tr>
                        <tr>
                            <td class="text-section">Mon exo de fou malade c'est t asc  asd asd asd rop styasdasdle asdah askdj</td>
                            <td class="icon-section">
                                <i class="fa-solid fa-chart-column"></i>
                                <i class="fa-solid fa-trash"></i>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-section">Mon exo</td>
                            <td class="icon-section">
                                <i class="fa-solid fa-chart-column"></i>
                                <i class="fa-solid fa-trash"></i>
                            </td>
                        </tr><tr>
                            <td class="text-section">Mon exo</td>
                            <td class="icon-section">
                                <i class="fa-solid fa-chart-column"></i>
                                <i class="fa-solid fa-trash"></i>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>
    </div>

<?php
$content = ob_get_clean();

//load layout
require __DIR__ . "/../layout.php";
