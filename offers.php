<html>
    <head>
        <style>
            .form{
                margin:25px; 
                padding:25px;
                background-color: bisque;
                border: 1px solid brown;
            }

            .form input , .form button{
                display: inline-block;
                margin-bottom: 15px;
                margin-right: 10px;
                padding:5px;
                border: 1px solid brown;
            }

            .form button{
                background-color: brown;
                color: bisque;
            }

            .results{
                margin:25px; 
                padding:25px;
                background-color: bisque;
                border: 1px solid brown;
            }

        </style>
    </head>

    <body>
        <!-- filtration form -->
        <div class="form">
            <h3>Tell us what you are looking for: </h3>
            <form method="get">
                <label>City : </label>
                <input type="text" placeholder="City" name="destinationCity">

                <label>Min Trip start date : </label>
                <input type="date" placeholder="Trip start date ( ex: 31-12-2017)" name="minTripStartDate">

                <label>Max Trip end date : </label>
                <input type="date" placeholder="Trip end date ( ex: 31-12-2017)" name="maxTripStartDate">

                <label>Lenght of stay : </label>
                <input type="text" placeholder="Lenght of stay" name="lengthOfStay"><br>

                <label>Min Total rate : </label>
                <input type="text" placeholder="Min Total rate" name="minTotalRate">

                <label>Max Total rate : </label>
                <input type="text" placeholder="Max total rate" name="maxTotalRate">

                <label>Min guest rating : </label>
                <input type="text" placeholder="Min guest rating" name="minGuestRating">

                <label>Max guest rating : </label>
                <input type="text" placeholder="Max guest Rating" name="maxGuestRating"><br>

                <label>Min star rating : </label>
                <input type="text" placeholder="Min star rating" name="minStarRating">

                <label>Max star rating : </label>
                <input type="text" placeholder="Max star rating" name="maxStarRating">


                <button type="submit"  name="go">Go!</button>

            </form>
        </div>

        <!--result of filtration-->        
        <div>

            <?php
            include 'offersController.php';
            $getOffersControllerIns = new getOffersController(); // instance of getOffersController class
            $offers = $getOffersControllerIns->getHotels(); // result.
       
            if($offers){ // in case the result contain offers .
                foreach( $offers as $offer) {
               // var_dump($offer);  
            ?>
                <div class='results'>

                    <h3>Hotel details:</h3>
                    <!--result as list -->
                    <ul>
                        <li>
                            <label>Hotel Name: </label>
                            <?php echo $offer['hotelInfo']['hotelName'] ?>
                        </li>
                        <li>
                            <img src='<?php echo $offer['hotelInfo']['hotelImageUrl']; ?>'  width='250px' height='250px'/>
                        </li>
                        <li>
                            <label> Destination:
                            </label><?php echo $offer['hotelInfo']['hotelDestination'] ?>
                        </li>
                        <li>
                            <label>Destination Region ID: </label>
                            <?php echo $offer['hotelInfo']['hotelDestinationRegionID'] ?>
                        </li>
                        <li>
                            <label>Long Destination: </label>
                            <?php echo $offer['hotelInfo']['hotelLongDestination'] ?>
                        </li>
                        <li> 
                            <label>Street Address: </label>
                            <?php echo $offer['hotelInfo']['hotelStreetAddress'] ?>
                        </li>
                        <li>
                            <label>City: </label>
                            <?php echo $offer['hotelInfo']['hotelCity'] ?>
                        </li>
                        <li>
                            <label>Province: </label>
                            <?php echo $offer['hotelInfo']['hotelProvince'] ?>
                             </li>
                        <li>
                            <label>Country Code: </label>
                            <?php echo $offer['hotelInfo']['hotelCountryCode'] ?>
                        </li>
                        <li>
                            <label>Latitude: </label>
                            <?php echo $offer['hotelInfo']['hotelLatitude'] ?>
                        </li>
                        <li>
                            <label>Longitude: </label>
                            <?php echo $offer['hotelInfo']['hotelLongitude'] ?>
                        </li>
                        <li>
                            <label>Star Rating: </label>
                            <?php echo $offer['hotelInfo']['hotelStarRating'] ?> 
                        </li>
                        <li>
                            <label>Guest Review Rating: </label>
                            <?php echo $offer['hotelInfo']['hotelGuestReviewRating'] ?>
                        </li>
                        <li>
                            <label>length Of Stay :</label>
                            <?php echo $offer['offerDateRange']['lengthOfStay'] ?>
                        </li>
                        <li>
                            <label>Travel Start Date:</label>
                            <?php echo isset($offer['offerDateRange']['travelStartDate']) ? $offer['offerDateRange']['travelStartDate'][0]."-".$offer['offerDateRange']['travelStartDate'][1]."-".$offer['offerDateRange']['travelStartDate'][2]: '' ?>
                        </li>

                        <li>
                            <label>Travel End Date:</label>
                            <?php echo isset($offer['offerDateRange']['travelEndDate']) ? $offer['offerDateRange']['travelEndDate'][0]."-".$offer['offerDateRange']['travelEndDate'][1]."-".$offer['offerDateRange']['travelEndDate'][2]: '' ?>
                        </li>
                    </ul>
                </div>
                <?php }
            }else{ 

                if (!empty($_GET)) { 

                    ?>

            <div class='results'>  No results found. </div>
                
                <?php
                 }
                    }   
                         ?>
            </div>
    </body>
    
