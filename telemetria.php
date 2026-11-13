<?php
    /*
    accetta un arrray di interi e restituisce un numero intero 
    */
    function contaPacchettiPersi($ping_grezzi){
        $pacchetti_persi = 0;

        foreach ( $ping_grezzi as $ping ){
            if($ping==-1){
                $pacchetti_persi++;
            }
        }

        return $pacchetti_persi;
    }
    /*
    accetta un array di interi e restituisce i ping validi
    */
    function pacchettiValidi($ping_grezzi){

        $ping_validi=[];

        foreach( $ping_grezzi as $ping ){

            if( $ping > 0 ){

                array_push($ping_validi, $ping);

            }

        }

        return $ping_validi;

    }
    /*
    accetta un array di intero e restituisce un double (2 decimali)
    */
    function calcolaTempoMedio($ping_validi){

        $somma = 0;
        $cont  = 0;
        $media = 0;

        foreach( $ping_validi as $ping ){
            $somma += $ping;
            $cont++;
        }

        $media = $somma / $cont;

        return round($media, 2);

    }
    /*
    accetta un array di interi e due interi per riferimento, non restituisce nulla.
    */
    function calcolaMinMax($ping_validi, &$min, &$max){

        $min = $ping_validi[0];
        $max = $ping_validi[0];

        foreach( $ping_validi as $ping ){

            if ( $ping > $max ) $max = $ping;
            if ( $ping < $min ) $min = $ping;

        }

    }

    //elaorazione dei dati

    $ping_grezzi = [45, 120, -1, 32, 210, 85, -1, 18, 95, 310, 45, 60, -1, 150, 28, 240,18, 72];

    array_push( $ping_grezzi, 55, 190, 12 );

    $ping_validi = pacchettiValidi($ping_grezzi);

    $tempo_media = calcolaTempoMedio($ping_validi);

    $ping_massimo = 0;
    $ping_minimo = 0;

    $pacchetti_persi = contaPacchettiPersi($ping_grezzi);

    calcolaMinMax($ping_validi, $ping_minimo, $ping_massimo);          

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- visualizzazione dei dati -->
    <ul>

      <li> Totale rilevazioni: <?php count($ping_grezzi); ?></li>
      <li> Pacchetti validi:   <?= count($ping_validi)    ?></li>
      <li> Pacchetti persi:    <?= $pacchetti_persi       ?></li>
      <li> Media:              <?= $tempo_media           ?></li>
      <li> Minimo:             <?= $ping_minimo           ?></li>
      <li> Massimo:            <?= $ping_massimo          ?></li>
    
    </ul>

    <table>

        <thead>
            <tr>
                <th> #         </th>
                <th> ping (ms) </th>
                <th> stato     </th>
            </tr>
        </thead>
        <tbody>
            <?php for ( $i = 0; $i < count($ping_validi); $i++ ): ?>

                <tr>
                    <td> <?= $i+1 ?> </td>
                    <td> <?= $ping_validi[$i]; ?> </td>
                    <td> <?= $ping_validi[$i] >= 150 ? "CRITICO" : "NORMALE" ?> </td>
                </tr>

            <?php endfor; ?>
        </tbody>

    </table>
    
</body>
</html>