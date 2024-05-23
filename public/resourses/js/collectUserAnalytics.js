window.onload = async function () {
    let ipResponse = await fetch('https://api.ipify.org?format=json');
    let ipData = await ipResponse.json();

    let userData = {
        'ip4': ipData.ip,
        'city': ymaps.geolocation.city,
        'platform': navigator.platform
    }
    await fetch('/actions/collect_user_analytics', {
        method: 'POST',
        body: JSON.stringify(userData)
    });
}