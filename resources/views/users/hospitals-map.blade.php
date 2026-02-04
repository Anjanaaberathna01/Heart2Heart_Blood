@extends('layouts.user')

@section('title', 'Available Hospitals Map - Heart2Heart LK')

@section('content')
<style>
    .map-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 20px;
    }

    .header {
        background: linear-gradient(135deg, #dc3545 0%, #a71e2a 100%);
        color: white;
        padding: 30px;
        border-radius: 10px;
        margin-bottom: 30px;
    }

    .header h1 {
        font-size: 28px;
        margin-bottom: 5px;
    }

    .header p {
        opacity: 0.9;
    }

    .map-section {
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
    }

    .map-section h2 {
        color: #dc3545;
        margin-bottom: 15px;
        font-size: 20px;
    }

    #hospital-map {
        width: 100%;
        height: 600px;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .stat-card .number {
        font-size: 32px;
        font-weight: 700;
        color: #28a745;
    }

    .stat-card .label {
        color: #666;
        font-size: 14px;
        margin-top: 5px;
    }

    .hospitals-list {
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .hospitals-list h2 {
        color: #dc3545;
        margin-bottom: 15px;
        font-size: 20px;
    }

    .hospital-item {
        padding: 15px;
        border-left: 4px solid #28a745;
        margin-bottom: 10px;
        background: #f8f9fa;
        border-radius: 5px;
    }

    .hospital-item h4 {
        color: #28a745;
        margin-bottom: 8px;
    }

    .hospital-item p {
        color: #666;
        font-size: 13px;
        margin: 3px 0;
    }

    .back-btn {
        display: inline-block;
        padding: 10px 20px;
        background-color: #667eea;
        color: white;
        text-decoration: none;
        border-radius: 6px;
        font-weight: 600;
        margin-bottom: 20px;
        transition: background-color 0.3s;
    }

    .back-btn:hover {
        background-color: #5568d3;
    }

    @media (max-width: 768px) {
        #hospital-map {
            height: 400px;
        }

        .map-container {
            padding: 10px;
        }
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>

<div class="map-container">
    <a href="{{ route('dashboard') }}" class="back-btn"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>

    <!-- Header -->
    <div class="header">
        <h1><i class="fas fa-map-location-dot"></i> Available Hospitals Map</h1>
        <p>Find blood donation hospitals near you</p>
    </div>

    <!-- Statistics -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="number">{{ $hospitals->where('available_for_donation', true)->count() }}</div>
            <div class="label">Available Hospitals</div>
        </div>
        <div class="stat-card">
            <div class="number">{{ $hospitals->where('available_for_donation', true)->groupBy('district')->count() }}</div>
            <div class="label">Districts Covered</div>
        </div>
        <div class="stat-card">
            <div class="number">18</div>
            <div class="label">Total Districts</div>
        </div>
    </div>

    <!-- Map Section -->
    <div class="map-section">
        <h2><i class="fas fa-map"></i> Interactive Map - Available Hospitals</h2>
        <div id="hospital-map"></div>
    </div>

    <!-- Hospitals List -->
    <div class="hospitals-list">
        <h2><i class="fas fa-list"></i> Available Hospitals List</h2>
        @php
            $availableHospitals = $hospitals->where('available_for_donation', true);
        @endphp
        @if($availableHospitals->isEmpty())
            <p style="color: #666; padding: 15px; background: #f8f9fa; border-radius: 6px;">
                <i class="fas fa-info-circle"></i> No hospitals are currently available. Please check back later.
            </p>
        @else
            @foreach($availableHospitals as $hospital)
                <div class="hospital-item">
                    <h4>{{ $hospital->user_name }}</h4>
                    <p><strong>Email:</strong> {{ $hospital->email }}</p>
                    <p><strong>Phone:</strong> {{ $hospital->mobile_number1 }}{{ $hospital->mobile_number2 ? ', ' . $hospital->mobile_number2 : '' }}</p>
                    <p><strong>District:</strong> {{ $hospital->district }}</p>
                    <p><strong>Address:</strong> {{ $hospital->address }}</p>
                </div>
            @endforeach
        @endif
    </div>
</div>

<script>
    // Initialize map centered on Sri Lanka
    const map = L.map('hospital-map').setView([7.8731, 80.7718], 7);

    // Add OpenStreetMap tiles
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors',
        maxZoom: 19
    }).addTo(map);

    // Hospital data from backend
    const hospitals = @json($hospitals);

    // Add slight random offset for hospitals in same district to avoid overlap
    function getHospitalCoordinates(hospital, index) {
        // Use stored coordinates if available, otherwise use district center
        if (hospital.latitude && hospital.longitude) {
            return [parseFloat(hospital.latitude), parseFloat(hospital.longitude)];
        }

        const districtCoordinates = {
            'Colombo': [6.9271, 80.6369],
            'Kandy': [7.2906, 80.6337],
            'Galle': [6.0535, 80.2157],
            'Negombo': [7.2067, 79.8589],
            'Matara': [5.9497, 80.5353],
            'Jaffna': [9.6615, 80.0255],
            'Trincomalee': [8.5874, 81.2853],
            'Batticaloa': [7.7102, 81.6924],
            'Vavuniya': [8.7557, 80.8051],
            'Mullativu': [8.3161, 81.8875],
            'Kurunegala': [7.4804, 80.3576],
            'Puttalam': [8.0328, 79.8228],
            'Anuradhapura': [8.3163, 80.4167],
            'Polonnaruwa': [7.9407, 81.0081],
            'Gampaha': [6.9497, 80.1137],
            'Kalutara': [6.5865, 80.3290],
            'Ratnapura': [6.6828, 80.3998],
            'Kegalle': [7.2531, 80.8428]
        };

        const baseCoords = districtCoordinates[hospital.district] || [7.8731, 80.7718];
        const offsetRange = 0.03;
        const offsetLat = (Math.random() - 0.5) * offsetRange * (index + 1);
        const offsetLng = (Math.random() - 0.5) * offsetRange * (index + 1);
        return [baseCoords[0] + offsetLat, baseCoords[1] + offsetLng];
    }

    // Add markers for each hospital
    let hospitalIndex = {};
    hospitals.forEach(hospital => {
        // Only show available hospitals
        if (!hospital.available_for_donation) {
            return;
        }

        // Track hospital count per district
        if (!hospitalIndex[hospital.district]) {
            hospitalIndex[hospital.district] = 0;
        }

        const coords = getHospitalCoordinates(hospital, hospitalIndex[hospital.district]);
        hospitalIndex[hospital.district]++;

        // Green for available hospitals
        const markerColor = '#28a745';
        const status = 'AVAILABLE';

        const marker = L.circleMarker(coords, {
            radius: 12,
            fillColor: markerColor,
            color: '#fff',
            weight: 2,
            opacity: 1,
            fillOpacity: 0.9
        }).addTo(map);

        // Popup with hospital info
        const popupContent = `
            <div style="font-family: Arial, sans-serif; width: 280px;">
                <h4 style="color: ${markerColor}; margin-bottom: 8px;">${hospital.user_name}</h4>
                <p><strong>Status:</strong> <span style="background: #d4edda; color: #155724; padding: 4px 8px; border-radius: 4px; font-weight: bold;">✓ ${status}</span></p>
                <p><strong>Email:</strong> ${hospital.email}</p>
                <p><strong>Phone:</strong> ${hospital.mobile_number1}${hospital.mobile_number2 ? ', ' + hospital.mobile_number2 : ''}</p>
                <p><strong>District:</strong> ${hospital.district}</p>
                <p><strong>Address:</strong> ${hospital.address}</p>
            </div>
        `;

        marker.bindPopup(popupContent);
    });

    // Add legend
    const legend = L.control({position: 'bottomright'});
    legend.onAdd = function() {
        const div = L.DomUtil.create('div', 'info');
        div.innerHTML = `
            <div style="background: white; padding: 15px; border-radius: 5px; box-shadow: 0 0 15px rgba(0,0,0,0.2);">
                <p style="margin: 0 0 8px 0; font-size: 12px; font-weight: bold;">Hospital Status</p>
                <p style="margin: 5px 0; font-size: 12px;">
                    <span style="display: inline-block; width: 12px; height: 12px; background: #28a745; border-radius: 50%; margin-right: 5px;"></span>
                    Available for Donation
                </p>
                <p style="margin: 8px 0 0 0; font-size: 11px; color: #666;">Click markers for details</p>
            </div>
        `;
        return div;
    };
    legend.addTo(map);
</script>
@endsection
