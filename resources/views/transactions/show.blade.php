<!DOCTYPE html>
<html>
<head>
    <title>Transaction Details</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f7f7f7;
            padding: 20px;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .card-header {
            padding: 20px;
            border-bottom: 1px solid #eee;
        }

        .card-header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-title {
            font-size: 20px;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-content {
            padding: 20px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
        }

        .field {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .field-label {
            font-size: 14px;
            color: #666;
        }

        .field-value {
            font-size: 16px;
        }

        .status-badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-success {
            background: #ecfdf5;
            color: #047857;
        }

        .monospace {
            font-family: 'Courier New', monospace;
        }

        .description {
            margin-top: 8px;
            color: #666;
            font-size: 14px;
            line-height: 1.5;
        }

		.activity-feed {
			padding: 20px 0;
		}

		.activity-list {
			list-style: none;
			padding: 0;
			margin: 0;
		}

		.activity-item {
			position: relative;
			display: flex;
			gap: 20px;
			align-items: flex-start;
			padding: 12px 0;
		}

		.timeline-line {
			position: absolute;
			left: 7px;
			top: 24px;
			bottom: -12px;
			width: 2px;
			background-color: #e5e7eb;
		}

		.activity-item:last-child .timeline-line {
			display: none;
		}

		.activity-dot {
			position: relative;
			width: 16px;
			height: 16px;
			border-radius: 50%;
			background-color: #f3f4f6;
			border: 2px solid #d1d5db;
			flex-shrink: 0;
		}

		.activity-dot.success {
			background-color: #4f46e5;
			border-color: #4f46e5;
		}

		.activity-content {
			flex: 1;
			font-size: 14px;
			color: #4b5563;
		}

		.activity-time {
			font-size: 12px;
			color: #6b7280;
			white-space: nowrap;
		}

		.activity-summary {
			margin-top: 20px;
			padding-top: 20px;
			border-top: 1px solid #e5e7eb;
			display: grid;
			grid-template-columns: repeat(3, 1fr);
			gap: 20px;
		}

		.summary-item {
			display: flex;
			flex-direction: column;
			gap: 4px;
		}

		.field-value.success {
			color: #047857;
		}

        @media (max-width: 768px) {
            .grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Transaction Summary -->
        <div class="card">
            <div class="card-header">
                <div class="card-header-content">
                    <h2 class="card-title">Transaction Details</h2>
                    <span class="status-badge status-success">Success</span>
                </div>
            </div>
            <div class="card-content grid">
                <div class="field">
                    <span class="field-label">Amount</span>
                    <span class="field-value">GHS 480.00</span>
                </div>
                <div class="field">
                    <span class="field-label">Reference</span>
                    <span class="field-value monospace">SUB_Z3MdUA_20250106030848</span>
                </div>
            </div>
        </div>

        <!-- Payment Details -->
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Payment Details</h2>
            </div>
            <div class="card-content grid">
                <div class="field">
                    <span class="field-label">Card Type</span>
                    <span class="field-value">VISA</span>
                </div>
                <div class="field">
                    <span class="field-label">Last 4 Digits</span>
                    <span class="field-value">**** 4081</span>
                </div>
                <div class="field">
                    <span class="field-label">Bank</span>
                    <span class="field-value">TEST BANK</span>
                </div>
                <div class="field">
                    <span class="field-label">Authorization Code</span>
                    <span class="field-value monospace">AUTH_3etycnrz44</span>
                </div>
            </div>
        </div>

        <!-- Customer Information -->
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Customer Information</h2>
            </div>
            <div class="card-content grid">
                <div class="field">
                    <span class="field-label">Name</span>
                    <span class="field-value">Farid Adam</span>
                </div>
                <div class="field">
                    <span class="field-label">Email</span>
                    <span class="field-value">faridibin@gmail.com</span>
                </div>
                <div class="field">
                    <span class="field-label">Phone</span>
                    <span class="field-value">4384093865</span>
                </div>
                <div class="field">
                    <span class="field-label">Customer Code</span>
                    <span class="field-value monospace">CUS_ed7kwh4zbmxqm21</span>
                </div>
            </div>
        </div>

        <!-- Plan Details -->
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Plan Details</h2>
            </div>
            <div class="card-content">
                <div class="field">
                    <span class="field-label">Plan Name</span>
                    <span class="field-value">Pro Plan</span>
                    <p class="description">The Pro Plan is designed for businesses looking to scale and streamline their invoicing operations.</p>
                </div>
                <div class="grid" style="margin-top: 20px;">
                    <div class="field">
                        <span class="field-label">Amount</span>
                        <span class="field-value">GHS 480.00</span>
                    </div>
                    <div class="field">
                        <span class="field-label">Billing Interval</span>
                        <span class="field-value">Annually</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Timing Information -->
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Timing Information</h2>
            </div>
            <div class="card-content grid">
                <div class="field">
                    <span class="field-label">Created At</span>
                    <span class="field-value">2025-01-06 03:08:48</span>
                </div>
                <div class="field">
                    <span class="field-label">Paid At</span>
                    <span class="field-value">2025-01-06 03:08:53</span>
                </div>
            </div>
        </div>

		<!-- Activity Log -->
		<div class="card">
			<div class="card-header">
				<h2 class="card-title">Activity Log</h2>
			</div>
			<div class="card-content">
				@foreach($transaction->log->history as $activity)
<li class="activity-item">
    <div class="timeline-line"></div>
    <div class="activity-dot {{ $activity->type === 'success' ? 'success' : '' }}"></div>
    <div class="activity-content">
        <p>{{ $activity->message }}</p>
    </div>
    <time class="activity-time">{{ $activity->time }}s</time>
</li>
@endforeach

<div class="activity-summary">
    <div class="summary-item">
        <span class="field-label">Time Spent</span>
        <span class="field-value">{{ $transaction->log->time_spent }} seconds</span>
    </div>
    <div class="summary-item">
        <span class="field-label">Attempts</span>
        <span class="field-value">{{ $transaction->log->attempts }}</span>
    </div>
    <div class="summary-item">
        <span class="field-label">Status</span>
        <span class="field-value {{ $transaction->log->success ? 'success' : '' }}">
            {{ $transaction->log->success ? 'Success' : 'Failed' }}
        </span>
    </div>
</div>
			</div>
		</div>
    </div>
</body>
</html>