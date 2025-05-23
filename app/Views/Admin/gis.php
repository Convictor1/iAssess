<!DOCTYPE html>
<html>

<head>
    <title>GIS Tax Map</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        #map {
            height: 100vh;
        }

        #sidebar {
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 1000;
            width: 300px;
            max-height: 90vh;
            overflow-y: auto;
            background: white;
            border: 1px solid #ccc;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
        }

        #sidebar.hidden {
            transform: translateX(-110%);
        }

        #toggleSidebarBtn {
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 1100;
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        }
    </style>

</head>

<body>
    <button id="toggleSidebarBtn">☰</button>

<div id="sidebar">
    <input type="text" id="search" class="form-control mb-2" placeholder="Search Lot #, Owner, or Barangay">
    <select id="zoneFilter" class="form-control mb-2">
        <option value="">All Zones</option>
        <option value="residential">Residential</option>
        <option value="commercial">Commercial</option>
        <option value="agricultural">Agricultural</option>
    </select>
    <div id="parcelList"></div>
</div>

<div id="map"></div>

   

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        document.getElementById('toggleSidebarBtn').addEventListener('click', function () {
        document.getElementById('sidebar').classList.toggle('hidden');
});

        const map = L.map('map').setView([13.4324, 123.4142], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Map data © OpenStreetMap contributors'
        }).addTo(map);

        let markers = [];
        let parcelData = [];

        fetch('<?= base_url('admin/parcels/fetch') ?>')
            .then(res => res.json())
            .then(parcels => {
                parcelData = parcels;
                renderMap(parcels);
                renderSidebar(parcels);
            });

        function getColor(classification) {
            switch (classification.toLowerCase()) {
                case 'residential': return 'green';
                case 'commercial': return 'red';
                case 'agricultural': return 'orange';
                default: return 'blue';
            }
        }

        function renderMap(data) {
            // Clear old markers
            markers.forEach(m => map.removeLayer(m));
            markers = [];

            data.forEach(parcel => {
                if (parcel.latitude && parcel.longitude) {
                    const color = getColor(parcel.classification || '');
                    const marker = L.circleMarker([parcel.latitude, parcel.longitude], {
                        color: color,
                        radius: 8
                    }).addTo(map);

                    marker.bindPopup(`
                    <b>${parcel.lot_number}</b><br>
                    Owner: ${parcel.owner_name}<br>
                    Barangay: ${parcel.barangay}<br>
                    Area: ${parcel.area} sqm<br>
                    Type: ${parcel.classification}
                `);

                    marker.parcel = parcel;
                    markers.push(marker);
                }
            });
        }

        function renderSidebar(data) {
            const sidebar = document.getElementById('parcelList');

            sidebar.innerHTML = '';

            data.forEach((parcel, index) => {
                const div = document.createElement('div');
                div.classList.add('mb-2');
                div.innerHTML = `<strong>${parcel.lot_number}</strong><br>${parcel.owner_name}<br><small>${parcel.barangay}</small>`;
                div.style.cursor = 'pointer';
                div.onclick = () => {
                    map.setView([parcel.latitude, parcel.longitude], 17);
                    markers[index].openPopup();
                };
                sidebar.appendChild(div);
            });
        }

        document.getElementById('search').addEventListener('input', function () {
            const keyword = this.value.toLowerCase();
            const filtered = parcelData.filter(p =>
                p.lot_number.toLowerCase().includes(keyword) ||
                p.owner_name.toLowerCase().includes(keyword) ||
                (p.barangay && p.barangay.toLowerCase().includes(keyword))
            );
            renderMap(filtered);
            renderSidebar(filtered);
        });

        document.getElementById('zoneFilter').addEventListener('change', function () {
            const zone = this.value.toLowerCase();
            const filtered = parcelData.filter(p =>
                !zone || (p.classification && p.classification.toLowerCase() === zone)
            );
            renderMap(filtered);
            renderSidebar(filtered);
        });
    </script>
</body>

</html>