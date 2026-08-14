# UptimeRobot Free Keep-Alive Setup

UptimeRobot is a free service that can ping your website every 5 minutes to keep it alive.

## Setup Steps:

### 1. Create UptimeRobot Account
- Go to: https://uptimerobot.com/
- Sign up for free account
- Free plan allows 50 monitors, 5-minute intervals

### 2. Create Monitor
1. Click **"+ Add New Monitor"**
2. **Monitor Type**: HTTP(s)
3. **Friendly Name**: `Simple Blog Platform`
4. **URL**: `https://simple-blogging-platform-iakn.onrender.com`
5. **Monitoring Interval**: 5 minutes (free tier)
6. Click **"Create Monitor"**

### 3. Optional: Add Health Check Monitor
1. Create second monitor
2. **URL**: `https://simple-blogging-platform-iakn.onrender.com/health-check.php`
3. **Friendly Name**: `Blog Platform Health Check`

## Benefits:
- ✅ **Completely Free** (50 monitors)
- ✅ **Reliable** (external service)
- ✅ **5-minute intervals** (better than 14 minutes)
- ✅ **Email notifications** if site goes down
- ✅ **No code changes needed**
- ✅ **No maintenance required**

## Alternative Free Services:
- **Uptime Kuma** (self-hosted)
- **StatusCake** (free tier)
- **Pingdom** (limited free)
- **Site24x7** (free tier)

## Recommended Combination:
1. **Primary**: UptimeRobot (every 5 minutes)
2. **Backup**: GitHub Actions (every 14 minutes during active hours)
3. **Health Check**: Custom endpoint for detailed monitoring

This ensures maximum uptime with zero cost!