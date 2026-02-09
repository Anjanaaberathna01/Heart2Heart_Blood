<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Hospital</title>
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

        input:focus, textarea:focus {
            outline: none;
            border-color: #e10600;
            box-shadow: 0 0 5px rgba(225, 6, 0, 0.3);
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        .button-group {
            display: flex;
            gap: 10px;
            margin-top: 30px;
        }

        button {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
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
        }

        .btn-cancel:hover {
            background-color: #ccc;
        }

        .error {
            color: #e10600;
            font-size: 12px;
            margin-top: 5px;
        }

        .success {
            color: #28a745;
            padding: 10px;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Add Hospital</h1>

    @if (session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div style="color: #e10600; margin-bottom: 20px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.store.hospital') }}">
        @csrf

        <div class="form-group">
            <label for="hospital_id">Hospital ID *</label>
            <input type="text" id="hospital_id" name="hospital_id" value="{{ old('hospital_id') }}" required>
            @error('hospital_id')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="hospital_reg_number">Hospital Registration Number *</label>
            <input type="text" id="hospital_reg_number" name="hospital_reg_number" value="{{ old('hospital_reg_number') }}" required>
            @error('hospital_reg_number')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="mobile_number1">Mobile Number 1 *</label>
            <input type="text" id="mobile_number1" name="mobile_number1" value="{{ old('mobile_number1') }}" placeholder="10 digits" maxlength="10" required>
            @error('mobile_number1')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="mobile_number2">Mobile Number 2</label>
            <input type="text" id="mobile_number2" name="mobile_number2" value="{{ old('mobile_number2') }}" placeholder="10 digits" maxlength="10">
            @error('mobile_number2')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="address">Address *</label>
            <textarea id="address" name="address" required>{{ old('address') }}</textarea>
            @error('address')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="district">District *</label>
            <select id="district" name="district" required>
                <option value="">Select District</option>
                <option value="Colombo">Colombo</option>
                <option value="Galle">Galle</option>
                <option value="Kandy">Kandy</option>
                <option value="Matara">Matara</option>
                <option value="Negombo">Negombo</option>
                <option value="Jaffna">Jaffna</option>
                <option value="Trincomalee">Trincomalee</option>
                <option value="Batticaloa">Batticaloa</option>
                <option value="Vavuniya">Vavuniya</option>
                <option value="Mullativu">Mullativu</option>
                <option value="Kurunegala">Kurunegala</option>
                <option value="Puttalam">Puttalam</option>
                <option value="Anuradhapura">Anuradhapura</option>
                <option value="Polonnaruwa">Polonnaruwa</option>
                <option value="Gampaha">Gampaha</option>
                <option value="Kalutara">Kalutara</option>
                <option value="Ratnapura">Ratnapura</option>
                <option value="Kegalle">Kegalle</option>
            </select>
            @error('district')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label><strong>Hospital Location on Map</strong> (Click on map to set exact location)</label>
            <div id="location-map" style="width: 100%; height: 300px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); margin-bottom: 10px;"></div>
            <p style="font-size: 12px; color: #666; margin-bottom: 10px;">Latitude: <strong id="lat-display">6.9271</strong> | Longitude: <strong id="lng-display">80.6369</strong></p>
        </div>

        <div class="form-group" style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
            <div>
                <label for="latitude">Latitude *</label>
                <input type="number" id="latitude" name="latitude" value="{{ old('latitude', '6.9271') }}" step="0.0001" required>
                @error('latitude')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="longitude">Longitude *</label>
                <input type="number" id="longitude" name="longitude" value="{{ old('longitude', '80.6369') }}" step="0.0001" required>
                @error('longitude')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="user_name">Hospital Username *</label>
            <input type="text" id="user_name" name="user_name" value="{{ old('user_name') }}" placeholder="Enter username for hospital login" required>
            @error('user_name')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Hospital Email *</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Enter email for hospital login" required>
            @error('email')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group" style="background-color: #e8f4f8; padding: 15px; border-radius: 5px; border-left: 4px solid #0066cc;">
            <p style="font-size: 13px; color: #0066cc; margin: 0;"><strong>Note:</strong> Default password will be set to <strong>12345678</strong>. Hospital can change it after first login.</p>
        </div>
            <button type="submit" class="btn-submit">Add Hospital</button>
            <a href="{{ route('admin.dashboard') }}" style="flex: 1; display: flex; align-items: center; justify-content: center; text-decoration: none;">
                <button type="button" class="btn-cancel" style="width: 100%;">Cancel</button>
            </a>
        </div>
    </form>
</div>

<script>
    // Initialize map
    const map = L.map('location-map').setView([6.9271, 80.6369], 8);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors',
        maxZoom: 19
    }).addTo(map);

    let marker = L.marker([6.9271, 80.6369]).addTo(map);

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
