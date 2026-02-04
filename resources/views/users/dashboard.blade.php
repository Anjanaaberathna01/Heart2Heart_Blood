@extends('layouts.user')

@section('title', 'User Dashboard - Heart2Heart LK')

@section('content')
<style>
    .dashboard-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .map-section {
        margin-bottom: 40px;
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .map-section h2 {
        color: #dc3545;
        margin-bottom: 15px;
        font-size: 24px;
    }

    #hospital-map {
        width: 100%;
        height: 500px;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .hospital-info {
        margin-top: 20px;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 8px;
    }

    .hospital-card {
        background: white;
        padding: 15px;
        margin: 10px 0;
        border-left: 4px solid #dc3545;
        border-radius: 5px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .hospital-card h4 {
        color: #dc3545;
        margin-bottom: 10px;
    }

    .hospital-card p {
        margin: 5px 0;
        color: #666;
        font-size: 14px;
    }

    .hospital-card strong {
        color: #333;
    }

    .welcome-section {
        background: linear-gradient(135deg, #dc3545 0%, #a71e2a 100%);
        color: white;
        padding: 30px;
        border-radius: 10px;
        margin-bottom: 30px;
    }

    .welcome-section h1 {
        margin-bottom: 10px;
    }

    .welcome-section p {
        opacity: 0.9;
    }

    .actions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        margin: 30px 0;
    }

    .action-card {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        color: #333;
    }

    .action-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
    }

    .action-card i {
        font-size: 32px;
        color: #dc3545;
        margin-bottom: 10px;
    }

    .action-card h3 {
        color: #dc3545;
        font-size: 16px;
    }

    @media (max-width: 768px) {
        #hospital-map {
            height: 300px;
        }

        .dashboard-container {
            padding: 10px;
        }

        .map-section {
            padding: 15px;
        }
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>

<div class="dashboard-container">
    <!-- Welcome Section -->
    <div class="welcome-section">
        <h1>Welcome to Heart2Heart LK</h1>
        <p>Blood Donation Management System - Find hospitals and request blood donations</p>
    </div>

    <!-- Map Section -->
    <div class="map-section">
        <h2>🏥 Hospital Locations in Sri Lanka</h2>
        <div id="hospital-map"></div>

        <div class="hospital-info">
            <h3 style="color: #dc3545; margin-bottom: 15px;">✓ Available Hospitals for Blood Donation</h3>
            <div id="hospital-list">
                @php
                    $availableHospitals = $hospitals->where('available_for_donation', true);
                @endphp
                @if($availableHospitals->isEmpty())
                    <p style="color: #666; padding: 15px; background: #f8f9fa; border-radius: 6px;">
                        <i class="fas fa-info-circle"></i> No hospitals are currently available for blood donation. Please check back later.
                    </p>
                @else
                    @foreach($availableHospitals as $hospital)
                        <div class="hospital-card">
                            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                                <div style="flex: 1;">
                                    <h4>{{ $hospital->user_name }}</h4>
                                    <p><strong>Email:</strong> {{ $hospital->email }}</p>
                                    <p><strong>Phone:</strong> {{ $hospital->mobile_number1 }}
                                        @if($hospital->mobile_number2)
                                            , {{ $hospital->mobile_number2 }}
                                        @endif
                                    </p>
                                    <p><strong>District:</strong> {{ $hospital->district }}</p>
                                    <p><strong>Address:</strong> {{ $hospital->address }}</p>
                                    <p style="margin-top: 8px; padding-top: 8px; border-top: 1px solid #e0e0e0;">
                                        <strong>Latitude:</strong> {{ $hospital->latitude ?? 'N/A' }}<br>
                                        <strong>Longitude:</strong> {{ $hospital->longitude ?? 'N/A' }}
                                    </p>
                                </div>
                                <span style="background: #d4edda; color: #155724; padding: 8px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; white-space: nowrap; margin-left: 15px;">
                                    ✓ Available
                                </span>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <!-- Action Cards -->
    <div class="actions-grid">
        <a href="{{ route('donate.request') }}" class="action-card">
            <div><i class="fas fa-droplet"></i></div>
            <h3>Blood Request</h3>
            <p>Request blood from hospitals</p>
        </a>
        <a href="{{ route('user.hospitals-map') }}" class="action-card">
            <div><i class="fas fa-map"></i></div>
            <h3>Hospital Map</h3>
            <p>View detailed hospitals map</p>
        </a>
        <a href="{{ route('user.history') }}" class="action-card">
            <div><i class="fas fa-history"></i></div>
            <h3>My History</h3>
            <p>View donation history</p>
        </a>
        <a href="{{ route('user.profile') }}" class="action-card">
            <div><i class="fas fa-user-circle"></i></div>
            <h3>My Profile</h3>
            <p>Update your profile</p>
        </a>
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
        // PRIORITY 1: Use exact coordinates set by admin during hospital registration
        // These are the precise GPS locations entered by admin in the location picker
        if (hospital.latitude && hospital.longitude) {
            const lat = parseFloat(hospital.latitude);
            const lng = parseFloat(hospital.longitude);
            // Verify coordinates are valid numbers
            if (!isNaN(lat) && !isNaN(lng)) {
                return [lat, lng]; // Return EXACT coordinates without any offset
            }
        }

        // PRIORITY 2: Fallback to district center if admin hasn't set exact coordinates
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
        // Apply small random offset only for approximate locations
        const offsetRange = 0.03;
        const offsetLat = (Math.random() - 0.5) * offsetRange * (index + 1);
        const offsetLng = (Math.random() - 0.5) * offsetRange * (index + 1);
        return [baseCoords[0] + offsetLat, baseCoords[1] + offsetLng];
    }

    // Add markers for each hospital
    let hospitalIndex = {};
    hospitals.forEach(hospital => {
        // Only show available hospitals on the user map
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
        // Hospitals with exact coordinates (set by admin) have slightly larger markers
        const hasExactCoordinates = hospital.latitude && hospital.longitude && !isNaN(parseFloat(hospital.latitude)) && !isNaN(parseFloat(hospital.longitude));
        const markerRadius = hasExactCoordinates ? 12 : 10;
        const markerColor = '#28a745';
        const status = 'AVAILABLE';

        // Debug logging
        console.log(`Hospital: ${hospital.user_name}, Lat: ${hospital.latitude}, Lng: ${hospital.longitude}, Has Exact: ${hasExactCoordinates}, Coords: [${coords[0]}, ${coords[1]}]`);

        const marker = L.circleMarker(coords, {
            radius: markerRadius,
            fillColor: markerColor,
            color: '#fff',
            weight: hasExactCoordinates ? 3 : 2,
            opacity: 1,
            fillOpacity: 0.9
        }).addTo(map);

        // Popup with hospital info
        const popupContent = `
            <div style="font-family: Arial, sans-serif; width: 250px;">
                <h4 style="color: ${markerColor}; margin-bottom: 8px;">${hospital.user_name}</h4>
                <p><strong>Status:</strong> <span style="color: ${markerColor}; font-weight: bold; background: #d4edda; padding: 4px 8px; border-radius: 4px;">✓ ${status}</span></p>
                <p><strong>Email:</strong> ${hospital.email}</p>
                <p><strong>Phone:</strong> ${hospital.mobile_number1}${hospital.mobile_number2 ? ', ' + hospital.mobile_number2 : ''}</p>
                <p><strong>District:</strong> ${hospital.district}</p>
                <p><strong>Address:</strong> ${hospital.address}</p>
                <p style="margin-top: 8px; padding-top: 8px; border-top: 1px solid #e0e0e0; font-size: 12px;">
                    <strong>Exact Location (GPS):</strong><br>
                    <strong>Latitude:</strong> ${hospital.latitude || 'Not set'}<br>
                    <strong>Longitude:</strong> ${hospital.longitude || 'Not set'}
                    ${hasExactCoordinates ? '<br><span style="color: #28a745; font-weight: bold;">✓ Admin Set</span>' : '<br><span style="color: #999;">Approximate</span>'}
                </p>
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
                <p style="margin: 0 0 8px 0; font-size: 12px; font-weight: bold;">Hospital Locations</p>
                <p style="margin: 5px 0; font-size: 12px;">
                    <span style="display: inline-block; width: 14px; height: 14px; background: #28a745; border-radius: 50%; margin-right: 5px;"></span>
                    Larger marker = Exact GPS coordinates (admin set)
                </p>
                <p style="margin: 5px 0; font-size: 12px;">
                    <span style="display: inline-block; width: 12px; height: 12px; background: #28a745; border-radius: 50%; margin-right: 5px;"></span>
                    Smaller marker = Approximate location
                </p>
                <p style="margin: 8px 0 0 0; font-size: 11px; color: #666;">Click markers to view exact coordinates</p>
            </div>
        `;
        return div;
    };
    legend.addTo(map);
</script>
@endsection
