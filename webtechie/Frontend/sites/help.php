<!--
    Diese Seite stellt ein FAQ Verfügung, welche in einem Akkordeon-Layout dargestellt werden. 
-->


<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="../../Frontend/Bilder/123.png">
    <meta charset="UTF-8">
    <title>FAQs</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

    
    <link rel="stylesheet" type="text/css" href="../CSS/help.css">
</head>

<body>

    <?php
    include "../../Backend/logic/header.php";
    ?>

    <div class="accordion accordion-flush" id="accordionFlushExample">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    What are your shipping options?
                </button>
            </h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <ul>
                        <li>We offer various shipping options to fit your needs. You can see the available options and
                            their estimated delivery times at checkout.<br></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                    What is your return policy?
                </button>
            </h2>
            <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <ul>
                        <li>We offer refund and/or exchange within the first 30 days of your purchase, if 30 days have
                            passed since your purchase, you will not be offered a refund and/or exchange of any
                            kind.<br></li>

                        <br>
                        <strong>Eligibility for Refunds and Exchanges:</strong>
                        <br>
                        <li> Your item must be unused and in the same condition that you received it.<br></li>

                        <li> The item must be in the original packaging.<br></li>

                        <li> To complete your return, we require a receipt or proof of purchase.<br></li>

                        <li> Only regular priced items may be refunded, sale items cannot be refunded.<br></li>

                        <li> If the item in question was marked as a gift when purchased and shipped directly to you,
                            you will receive a gift credit for the value of your return.<br></li>
                        </li>

                    </ul>
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                    How can I track my order?
                </button>
            </h2>
            <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <ul>
                        <li>Once your order ships, you'll receive a confirmation email with tracking information. You
                            can then track your order directly with the courier company.</li>

                    </ul>
                </div>
            </div>
        </div>

        <div class="accordion-item">
    <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
            I can't find the answer to my question. What should I do?
        </button>
    </h2>
    <div id="flush-collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
        <div class="accordion-body">
            <ul>
                <li>If you can't find the answer to your question in our FAQ, feel free to contact us by email:
                    BaaS@bricks.com or by phone (06761234567). We're happy to help!</li>
            </ul>
        </div>
    </div>
</div>


</body>

</html>