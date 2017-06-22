<!DOCTYPE html>
<html>
    <head>
        <title>Pohvale & pritozbe</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
        <link href='../oblika/style.css' rel='stylesheet' type='text/css'>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script type="text/javascript">
            //auto expand textarea
            function adjust_textarea(h) {
                h.style.height = "20px";
                h.style.height = (h.scrollHeight) + "px";
            }

            //skrij & prikazi ustrezen div
            $(document).ready(function () {
                $(".ch").hide(0);
                $(".pp").hide(0);
                $('input[type="radio"]').click(function () { // ob kliku na radio button
                    if ($(this).attr("value") == "pohvala") {
                        $(".pp").not(".pohvala").hide(780);
                        $(".pohvala").show(780);
                        
                        $(".ch").not(".zapo").hide(780); // poenostavim vse spodnje zadeve
                        $(".ch").not(".pros").hide(780);
                        $('.enka').prop('selectedIndex', 0);
                        $('.dvojka').prop('selectedIndex', 0);
                        $('.selektam').prop('selectedIndex',0);
                    }
                    if ($(this).attr("value") == "pritozba") {
                        $(".pp").not(".pritozba").hide(780);
                        $(".pritozba").show(780);
                        
                        $(".ch").not(".zapo").hide(780); // poenostavim vse spodnje zadeve
                        $(".ch").not(".pros").hide(780);
                        $('.enka').prop('selectedIndex', 0);
                        $('.dvojka').prop('selectedIndex', 0);
                        $('.selektam').prop('selectedIndex',0);
                    }
                });
                $('.selektam').on('change', function () { // select stavek, ko se spremeni naredi nekaj
                    if ($(this).val() == 'prostor') {
                        $(".ch").not(".pros").hide(780);
                        $(".pros").show(780);
                    }
                    if ($(this).val() == 'zaposleni') {
                        $(".ch").not(".zapo").hide(780);
                        $(".zapo").show(780);
                    }
                    if ($(this).val() == 'drugo') {
                        $(".ch").not(".zapo").hide(780); // poenostavim vse spodnje zadeve
                        $(".ch").not(".pros").hide(780);
                        $('.enka').prop('selectedIndex', 0);
                        $('.dvojka').prop('selectedIndex', 0);
                    }
                });

                /*Resetiram selecte*/
                $('.enka').change(function () {
                    $('.dvojka').prop('selectedIndex', 0);
                });

                $('.dvojka').change(function () {
                    $('.enka').prop('selectedIndex', 0);
                });
            });
            
        </script>
    </head>
    <body>
        <?php
        session_start();
        ?>
        <div class = "form-style-8">
            <h2>Pohvale in pritozbe</h2>

            <h3>Oddal bi:</h3>

            Pohvalo<input type="radio" name="pp" value="pohvala"/><br>
            Pritožbo<input type="radio" name="pp" value="pritozba"/>
            <br><br>

            <div class="pp pohvala">
                <h3>Pohvala:</h3>
                <select class='selektam'>
                        <option disabled selected value> --- izberi --- </option>
                        <option id="z" value="zaposleni">Zaposleni na soli</option>
                        <option id="p" value="prostor">Prostor na soli</option>
                        <option id="d" value="drugo">Drugo(sportni dnevi, malica, ipd.)</option>
                </select>
                
                <form class="formica" method="post" action="akcija.php">
                    <div class='ch zapo fixedC'>
                        <select name="zaposleni" class='enka'>
                            <option disabled selected value> --- izberi ---</option>
                            <?php
                            include_once '../control/pohv_pri.php';
                            $abc = new pp();
                            $res = $abc->vrniVseZaposlene(); // vrnem zaposlene
                            while ($row = pg_fetch_assoc($res)) {
                                echo '<option value="' . htmlspecialchars($row['ime_prii']) . '">' . htmlspecialchars($row['ime_prii']) . '</option>';
                            }
                            pg_close($db);
                            ?>
                        </select>
                    </div>
                    <div class='ch pros fixedC'>
                        <select name="prostori" class='dvojka'>
                            <option disabled selected value> --- izberi ---</option>
                            <?php
                            $res = $abc->vrniVseProstore(); // vrnem zaposlene
                            while ($row = pg_fetch_assoc($res)) {
                                echo '<option value="' . htmlspecialchars($row['naziv']) . '">' . htmlspecialchars($row['naziv']) . '</option>';
                            }
                            pg_close($db);
                            ?>
                        </select>
                    </div>
                    
                    <input placeholder="Vzrok/namen pohvale" name="ime" type="text"/>
                    <textarea placeholder="Besedilo pohvale" name = "besedilo" onkeyup = "adjust_textarea(this)"></textarea>
                    <input type = "submit" name="submit" value = "Pohvala" />
                </form>
            </div>

            <div class='pp pritozba'>
                <h3>Pritozba:</h3>
                <select class='selektam'>
                    <option disabled selected value> --- izberi --- </option>
                    <option id="z" value="zaposleni">Zaposleni na soli</option>
                    <option id="p" value="prostor">Prostor na soli</option>
                    <option id="d" value="drugo">Drugo(sportni dnevi, malica, ipd.)</option>
                </select>

                <form class="formica" method="post" action="akcija.php">
                    <div class='ch zapo fixedC'>
                        <select name="zaposleni" class='enka'>
                            <option disabled selected value> --- izberi ---</option>
                            <?php
                            $abcd = new pp();
                            $res = $abcd->vrniVseZaposlene(); // vrnem zaposlene
                            while ($row = pg_fetch_assoc($res)) {
                                echo '<option value="' . htmlspecialchars($row['ime_prii']) . '">' . htmlspecialchars($row['ime_prii']) . '</option>';
                            }
                            pg_close($db);
                            ?>
                        </select>
                    </div>
                    <div class='ch pros fixedC'>
                        <select name="prostori" class='dvojka'>
                            <option disabled selected value> --- izberi ---</option>
                            <?php
                            $res = $abcd->vrniVseProstore(); // vrnem zaposlene
                            while ($row = pg_fetch_assoc($res)) {
                                echo '<option value="' . htmlspecialchars($row['naziv']) . '">' . htmlspecialchars($row['naziv']) . '</option>';
                            }
                            pg_close($db);
                            ?>
                        </select>
                    </div>

                    <input placeholder="Vzrok/namen pritožbe" type = "text" name = "ime" autocomplete="off"/>
                    <textarea placeholder="Besedilo pritožbe" name = "besedilo" onkeyup = "adjust_textarea(this)" autocomplete="off"></textarea>
                    <input type = "submit" name = "submit" value = "Pritozba" />
                </form>
            </div>
        </div>
    </body> 
</html>