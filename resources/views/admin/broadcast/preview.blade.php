@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Broadcast Preview</h2>
        <a href="{{ route('admin.broadcast.create') }}" class="btn btn-outline-secondary">Back to Edit</a>
    </div>

    <div class="alert alert-info">
        <i class="bi bi-info-circle-fill me-2"></i> 
        <strong>Ready to broadcast to {{ $broadcastData->count() }} users.</strong><br>
        Click "Start Broadcast" to automatically open WhatsApp Web for each user sequentially. 
        Please allow popups if prompted.
    </div>

    <!-- Progress Bar -->
    <div class="progress mb-4" style="height: 25px; display: none;" id="progressBarContainer">
        <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 0%;" id="progressBar">0%</div>
    </div>

    <div class="mb-4 text-center d-flex justify-content-center gap-3">
        <button id="startBtn" class="btn btn-lg btn-success px-4" onclick="startCampaign()">
            <i class="bi bi-whatsapp me-2"></i> Start WhatsApp Broadcast
        </button>

        <form action="{{ route('admin.broadcast.send_email') }}" method="POST" onsubmit="return confirm('Send email to all {{ $broadcastData->count() }} users?');">
            @csrf
            <input type="hidden" name="meet_link" value="{{ $meetLink }}">
            <input type="hidden" name="message" value="{{ $message }}">
            <button type="submit" class="btn btn-lg btn-primary px-4">
                <i class="bi bi-envelope-fill me-2"></i> Send to All via Email
            </button>
        </form>
    </div>
    
    <div id="statusText" class="text-center text-muted mb-3"></div>

    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3">
            <h5 class="card-title mb-0">Recipient List</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 50px;">#</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($broadcastData as $index => $data)
                            <tr id="row-{{ $index }}">
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $data['name'] }}</td>
                                <td>{{ $data['phone'] }}</td>
                                <td><span class="badge bg-secondary status-badge">Pending</span></td>
                                <td class="text-end">
                                    <a href="https://wa.me/{{ $data['phone'] }}?text={{ urlencode($data['message']) }}" 
                                       target="_blank" 
                                       class="btn btn-sm btn-outline-success manual-send-btn">
                                       Send Manually <i class="bi bi-box-arrow-up-right"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    const users = @json($broadcastData);
    let currentIndex = 0;
    let isRunning = false;

    function startCampaign() {
        if (isRunning) return;
        
        if (!confirm('This will open ' + users.length + ' WhatsApp tabs sequentially. Are you sure?')) {
            return;
        }

        isRunning = true;
        document.getElementById('startBtn').disabled = true;
        document.getElementById('startBtn').innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Sending...';
        document.getElementById('progressBarContainer').style.display = 'flex';
        
        processNext();
    }

    function processNext() {
        if (currentIndex >= users.length) {
            finishCampaign();
            return;
        }

        const user = users[currentIndex];
        const row = document.getElementById('row-' + currentIndex);
        const badge = row.querySelector('.status-badge');
        
        // Update Status
        badge.className = 'badge bg-warning text-dark status-badge';
        badge.innerText = 'Processing...';
        document.getElementById('statusText').innerText = `Opening WhatsApp for ${user.name} (${currentIndex + 1}/${users.length})...`;

        // Construct URL
        const url = `https://wa.me/${user.phone}?text=${encodeURIComponent(user.message)}`;
        
        // Open Window
        const win = window.open(url, '_blank');
        
        if (win) {
            badge.className = 'badge bg-success status-badge';
            badge.innerText = 'Opened';
            // Optional: Close tab after some time? No, user needs to click send.
            // But we can verify it opened.
        } else {
            badge.className = 'badge bg-danger status-badge';
            badge.innerText = 'Blocked (Popup)';
            alert('Popup blocked! Please allow popups for this site and try again.');
            isRunning = false;
            return; 
        }

        // Update Progress
        currentIndex++;
        const percent = Math.round((currentIndex / users.length) * 100);
        const bar = document.getElementById('progressBar');
        bar.style.width = percent + '%';
        bar.innerText = percent + '%';

        // Wait before next (e.g., 2 seconds to not freeze browser)
        setTimeout(processNext, 1500); 
    }

    function finishCampaign() {
        isRunning = false;
        document.getElementById('startBtn').className = 'btn btn-lg btn-secondary px-5';
        document.getElementById('startBtn').innerText = 'Campaign Completed';
        document.getElementById('statusText').innerText = 'All tabs opened successfully.';
        alert('All WhatsApp tabs have been opened. Please go through each tab and click send.');
    }
</script>
@endsection
