<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Hospital</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", Arial, sans-serif;
        }

        body {
            background-color: #f5f5f5;
            padding: 20px;
        }

        .container {
            max-width: 700px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #e10600;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            font-weight: 600;
        }

        input, textarea, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            font-family: "Poppins", Arial, sans-serif;
        }

        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: #e10600;
            box-shadow: 0 0 5px rgba(225, 6, 0, 0.3);
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .button-group {
            display: flex;
            gap: 10px;
            margin-top: 30px;
        }

        button, a {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-submit {
            background-color: #e10600;
            color: #fff;
        }

        .btn-submit:hover {
            background-color: #b80500;
        }

        .btn-cancel {
            background-color: #ddd;
            color: #333;
            text-decoration: none;
        }

        .btn-cancel:hover {
            background-color: #ccc;
        }

        .error {
            color: #e10600;
            font-size: 12px;
            margin-top: 5px;
        }

        .error-list {
            color: #e10600;
            margin-bottom: 20px;
            padding: 10px;
            background-color: #ffe6e6;
            border: 1px solid #ffcccc;
            border-radius: 5px;
        }

        .error-list ul {
            margin-left: 20px;
        }

        .success {
            color: #28a745;
            padding: 10px;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .readonly-info {
            background-color: #f0f0f0;
            padding: 10px;
            border-radius: 5px;
            font-size: 12px;
            color: #666;
            margin-bottom: 15px;
        }

        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }

            .button-group {
                flex-direction: column;
            }

            button, a {
                width: 100%;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Edit Hospital Details</h1>

    @if (session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="error-list">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="readonly-info">
         Hospital ID and Registration Number cannot be changed after creation.
    </div>

    <form method="POST" action="{{ route('admin.hospitals.update', $hospital) }}">
        @csrf
        @method('PUT')

        <div class="form-row">
            <div class="form-group">
                <label for="hospital_id">Hospital ID (Read-only)</label>
                <input type="text" id="hospital_id" name="hospital_id" value="{{ $hospital->hospital_id }}" readonly style="background-color: #f5f5f5; cursor: not-allowed;">
            </div>

            <div class="form-group">
                <label for="hospital_reg_number">Registration Number (Read-only)</label>
                <input type="text" id="hospital_reg_number" name="hospital_reg_number" value="{{ $hospital->hospital_reg_number }}" readonly style="background-color: #f5f5f5; cursor: not-allowed;">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="user_name">Hospital Username *</label>
                <input type="text" id="user_name" name="user_name" value="{{ old('user_name', $hospital->user_name) }}" required>
                @error('user_name')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Hospital Email *</label>
                <input type="email" id="email" name="email" value="{{ old('email', $hospital->email) }}" required>
                @error('email')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="mobile_number1">Mobile Number 1 *</label>
                <input type="text" id="mobile_number1" name="mobile_number1" value="{{ old('mobile_number1', $hospital->mobile_number1) }}" placeholder="10 digits" maxlength="10" required>
                @error('mobile_number1')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="mobile_number2">Mobile Number 2</label>
                <input type="text" id="mobile_number2" name="mobile_number2" value="{{ old('mobile_number2', $hospital->mobile_number2) }}" placeholder="10 digits" maxlength="10">
                @error('mobile_number2')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="address">Address *</label>
            <textarea id="address" name="address" required>{{ old('address', $hospital->address) }}</textarea>
            @error('address')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="district">District *</label>
            <select id="district" name="district" required>
                <option value="">Select District</option>
                <option value="Colombo" {{ old('district', $hospital->district) === 'Colombo' ? 'selected' : '' }}>Colombo</option>
                <option value="Galle" {{ old('district', $hospital->district) === 'Galle' ? 'selected' : '' }}>Galle</option>
                <option value="Kandy" {{ old('district', $hospital->district) === 'Kandy' ? 'selected' : '' }}>Kandy</option>
                <option value="Matara" {{ old('district', $hospital->district) === 'Matara' ? 'selected' : '' }}>Matara</option>
                <option value="Negombo" {{ old('district', $hospital->district) === 'Negombo' ? 'selected' : '' }}>Negombo</option>
                <option value="Jaffna" {{ old('district', $hospital->district) === 'Jaffna' ? 'selected' : '' }}>Jaffna</option>
                <option value="Trincomalee" {{ old('district', $hospital->district) === 'Trincomalee' ? 'selected' : '' }}>Trincomalee</option>
                <option value="Batticaloa" {{ old('district', $hospital->district) === 'Batticaloa' ? 'selected' : '' }}>Batticaloa</option>
                <option value="Vavuniya" {{ old('district', $hospital->district) === 'Vavuniya' ? 'selected' : '' }}>Vavuniya</option>
                <option value="Mullativu" {{ old('district', $hospital->district) === 'Mullativu' ? 'selected' : '' }}>Mullativu</option>
                <option value="Kurunegala" {{ old('district', $hospital->district) === 'Kurunegala' ? 'selected' : '' }}>Kurunegala</option>
                <option value="Puttalam" {{ old('district', $hospital->district) === 'Puttalam' ? 'selected' : '' }}>Puttalam</option>
                <option value="Anuradhapura" {{ old('district', $hospital->district) === 'Anuradhapura' ? 'selected' : '' }}>Anuradhapura</option>
                <option value="Polonnaruwa" {{ old('district', $hospital->district) === 'Polonnaruwa' ? 'selected' : '' }}>Polonnaruwa</option>
                <option value="Gampaha" {{ old('district', $hospital->district) === 'Gampaha' ? 'selected' : '' }}>Gampaha</option>
                <option value="Kalutara" {{ old('district', $hospital->district) === 'Kalutara' ? 'selected' : '' }}>Kalutara</option>
                <option value="Ratnapura" {{ old('district', $hospital->district) === 'Ratnapura' ? 'selected' : '' }}>Ratnapura</option>
                <option value="Kegalle" {{ old('district', $hospital->district) === 'Kegalle' ? 'selected' : '' }}>Kegalle</option>
            </select>
            @error('district')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label><strong>Hospital Location on Map</strong> (Click on map to set exact location)</label>
            <div id="location-map" style="width: 100%; height: 300px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); margin-bottom: 10px;"></div>
            <p style="font-size: 12px; color: #666; margin-bottom: 10px;">Latitude: <strong id="lat-display">{{ $hospital->latitude ?? '6.9271' }}</strong> | Longitude: <strong id="lng-display">{{ $hospital->longitude ?? '80.6369' }}</strong></p>
        </div>

        <div class="form-group" style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
            <div>
                <label for="latitude">Latitude *</label>
                <input type="number" id="latitude" name="latitude" value="{{ old('latitude', $hospital->latitude ?? '6.9271') }}" step="0.0001" required>
                @error('latitude')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="longitude">Longitude *</label>
                <input type="number" id="longitude" name="longitude" value="{{ old('longitude', $hospital->longitude ?? '80.6369') }}" step="0.0001" required>
                @error('longitude')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="button-group">
            <button type="submit" class="btn-submit">Update Hospital</button>
            <a href="{{ route('admin.dashboard') }}" class="btn-cancel">Cancel</a>
        </div>
    </form>
</div>

<script>
    // Initialize map with hospital's current location
    const initialLat = parseFloat(document.getElementById('latitude').value);
    const initialLng = parseFloat(document.getElementById('longitude').value);

    const map = L.map('location-map').setView([initialLat, initialLng], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors',
        maxZoom: 19
    }).addTo(map);

    let marker = L.marker([initialLat, initialLng]).addTo(map);

    // Update marker and form when map is clicked
    map.on('click', function(e) {
        const lat = e.latlng.lat.toFixed(4);
        const lng = e.latlng.lng.toFixed(4);

        // Update marker position
        marker.setLatLng(e.latlng);

        // Update form fields
        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lng;
        document.getElementById('lat-display').textContent = lat;
        document.getElementById('lng-display').textContent = lng;
    });

    // Update marker when latitude/longitude fields change
    document.getElementById('latitude').addEventListener('change', updateMapMarker);
    document.getElementById('longitude').addEventListener('change', updateMapMarker);

    function updateMapMarker() {
        const lat = parseFloat(document.getElementById('latitude').value);
        const lng = parseFloat(document.getElementById('longitude').value);

        if (lat && lng) {
            marker.setLatLng([lat, lng]);
            map.setView([lat, lng], 13);
            document.getElementById('lat-display').textContent = lat.toFixed(4);
            document.getElementById('lng-display').textContent = lng.toFixed(4);
        }
    }
</script>
</body>
</html>
