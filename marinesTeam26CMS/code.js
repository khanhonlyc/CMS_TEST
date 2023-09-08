fetch('https://membertest060225.team26.jp/mix/FmaMemberRedirect?code=999&fan=8933887687&fanPass=TEAM26CLM', {
	method: 'GET',
	withCredentials: true,
	crossorigin: true,
	mode: 'no-cors',
	credentials: 'include',
	headers: {
		'Access-Control-Allow-Origin': '*',
		'Cookie': 'JSESSIONID=F4A56AFC0095A50E402DCB836530765E',
		'Content-Type': 'application/json'
	},
}).then((response) => {
	fetch('https://membertest060225.team26.jp/mix/api/FmaMemberPersonalData', {
		method: 'GET',
		withCredentials: true,
		crossorigin: true,
		mode: 'no-cors',
		credentials: 'include',
		headers: {
			'Access-Control-Allow-Origin': '*',
			'Cookie': 'JSESSIONID=F4A56AFC0095A50E402DCB836530765E',
			'Content-Type': 'application/json'
		},
	}).then((response) => {
		return response.json();
	}).then((response) => {
		console.log(response);
	}).catch(function(err) {
		console.log('Fetch Error :-S', err);
	});
	return response.json();
}).then((response) => {
	console.log(response);
}).catch(function(err) {
	console.log('Fetch Error :-S', err);
});
// ==
{
  "csrfToken": "31d4d284-2d21-4459-a03e-d3d964542aea",
  "httpStatus": "OK",
  "fanName": "ホット　テスト",
  "fcRankName": "Ｍ１",
  "presentComming": "0",
  "necessaryPoint": "1000",
  "nextFcRankName": "Ｍ１",
  "fanTypeCode": "09",
  "fanTypeName": "無料",
  "savingPointList": [
    {
      "occurYear": "2022",
      "point": 0,
      "validDate": "2024-01-31",
      "pointType": "03",
      "pointTypeName": "ステージポイント",
      "pointTypeShortName": "ｽﾃｰｼﾞﾎﾟｲﾝﾄ",
      "pointUnit": "Mpt"
    },
    {
      "occurYear": "2022",
      "point": 0,
      "validDate": "2024-01-31",
      "pointType": "01",
      "pointTypeName": "Ｍポイント",
      "pointTypeShortName": "Mﾎﾟｲﾝﾄ",
      "pointUnit": "Mpt"
    },
    {
      "occurYear": "2021",
      "point": 0,
      "validDate": "2023-01-31",
      "pointType": "03",
      "pointTypeName": "ステージポイント",
      "pointTypeShortName": "ｽﾃｰｼﾞﾎﾟｲﾝﾄ",
      "pointUnit": "Mpt"
    },
    {
      "occurYear": "2021",
      "point": 0,
      "validDate": "2023-01-31",
      "pointType": "01",
      "pointTypeName": "Ｍポイント",
      "pointTypeShortName": "Mﾎﾟｲﾝﾄ",
      "pointUnit": "Mpt"
    }
  ],
  "amcNo": "8933887687",
  "responceMessages": []
}