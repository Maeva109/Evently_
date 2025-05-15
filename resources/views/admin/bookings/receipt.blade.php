<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Receipt #{{ $booking->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .receipt-title {
            font-size: 24px;
            color: #333;
            margin-bottom: 10px;
        }
        .receipt-number {
            color: #666;
            font-size: 16px;
        }
        .section {
            margin-bottom: 20px;
        }
        .section-title {
            font-size: 18px;
            color: #333;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }
        .details {
            margin-left: 20px;
        }
        .row {
            margin-bottom: 5px;
        }
        .label {
            font-weight: bold;
            color: #666;
        }
        .total {
            margin-top: 20px;
            padding-top: 10px;
            border-top: 2px solid #ddd;
        }
        .total .amount {
            font-size: 18px;
            font-weight: bold;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            color: #666;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="receipt-title">Payment Receipt</div>
        <div class="receipt-number">Receipt #{{ $booking->id }}</div>
        <div>{{ now()->format('F d, Y') }}</div>
    </div>

    <div class="section">
        <div class="section-title">Event Details</div>
        <div class="details">
            <div class="row">
                <span class="label">Event:</span>
                <span>{{ $booking->event->title }}</span>
            </div>
            <div class="row">
                <span class="label">Date:</span>
                <span>{{ $booking->event->start_date->format('F d, Y') }}</span>
            </div>
            <div class="row">
                <span class="label">Time:</span>
                <span>{{ $booking->event->start_date->format('h:i A') }}</span>
            </div>
            <div class="row">
                <span class="label">Location:</span>
                <span>{{ $booking->event->location }}</span>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Customer Information</div>
        <div class="details">
            <div class="row">
                <span class="label">Name:</span>
                <span>{{ $booking->user->name }}</span>
            </div>
            <div class="row">
                <span class="label">Email:</span>
                <span>{{ $booking->user->email }}</span>
            </div>
            <div class="row">
                <span class="label">Booking Date:</span>
                <span>{{ $booking->created_at->format('F d, Y') }}</span>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Ticket Details</div>
        <div class="details">
            <div class="row">
                <span class="label">Ticket Type:</span>
                <span>{{ $booking->ticketType->name }}</span>
            </div>
            <div class="row">
                <span class="label">Quantity:</span>
                <span>{{ $booking->quantity }}</span>
            </div>
            <div class="row">
                <span class="label">Price per Ticket:</span>
                <span>${{ number_format($booking->ticketType->price, 2) }}</span>
            </div>
            <div class="total">
                <span class="label">Total Amount:</span>
                <span class="amount">${{ number_format($booking->total_price, 2) }}</span>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>Thank you for your purchase!</p>
        <p>This is an official receipt for your records.</p>
        <p>For any questions, please contact support.</p>
    </div>
</body>
</html> 