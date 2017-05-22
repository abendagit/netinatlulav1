<?php
    function getPickupLocations() {
        $areas_gid = array(            
            "צפון" => 0,
            "דרום" => 1516899758,
            "ירושלים והסביבה" => 1939554596,
            "גוש דן ומרכז" => 667563898,
            "שומרון ובנימין" => 1878796893,
            "יהודה" => 1643519275,
            "שרון" => 1656442191,
        );
        $pickup_locations_raw = array_map(
            function($gid) { 
                return file_get_contents("https://docs.google.com/spreadsheets/d/1V5QCH067nG7_S0MVYd6n9ZGt4a1dWqldv0I1OWBUHj4/pub?output=tsv&gid=".$gid);
            },
            $areas_gid
        );
        $pickup_locations = array_map(
            function ($data) {
                $rows = explode("\n", $data);
                array_shift($rows);
                $locations = array();
                foreach ($rows as $row) {
                    $fields = explode("\t", $row);
                    $locations[$fields[0]] = $fields;
                }
                return $locations;
            },
            $pickup_locations_raw
        );
        echo json_encode($pickup_locations);    
    }
?>