<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $locations = explode(',', $_POST['locations']);
    $locations = array_map('trim', $locations);

    // Fungsi untuk menghitung jarak antar lokasi
    function calculateDistance($loc1, $loc2) {
        $loc1 = explode(',', $loc1);
        $loc2 = explode(',', $loc2);

        // Pastikan kita memiliki dua elemen (latitude dan longitude)
        if (count($loc1) < 2 || count($loc2) < 2) {
            return 0; // Jika tidak ada cukup data, kembalikan 0
        }

        $lat1 = $loc1[0];
        $lng1 = $loc1[1];
        $lat2 = $loc2[0];
        $lng2 = $loc2[1];

        // Menghitung jarak menggunakan rumus Haversine
        $earthRadius = 6371; // Radius bumi dalam km
        $dLat = deg2rad($lat2 - $lat1);
        $dLng = deg2rad($lng2 - $lng1);
        $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLng / 2) * sin($dLng / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        return $earthRadius * $c; // Mengembalikan jarak dalam km
    }

    // Algoritma Genetik (sederhana)
    function geneticAlgorithm($locations) {
        // Inisialisasi populasi, fungsi fitness, seleksi, crossover, dan mutasi
        // Ini adalah tempat Anda akan menambahkan logika algoritma genetik

        // Contoh hasil (rute acak)
        shuffle($locations);
        return $locations;
    }

    // Hitung rute terbaik
    $bestRoute = geneticAlgorithm($locations);
    $totalDistance = 0;

    // Menghitung total jarak untuk rute terbaik
    for ($i = 0; $i < count($bestRoute) - 1; $i++) {
        $totalDistance += calculateDistance($bestRoute[$i], $bestRoute[$i + 1]);
    }

    // Menampilkan hasil
    echo "<h1>Rute Terbaik</h1>";
    echo "<p>Rute: " . implode(' -> ', $bestRoute) . "</p>";
    echo "<p>Total Jarak: " . round($totalDistance, 2) . " km</p>";
}
?>