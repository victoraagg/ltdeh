<?php

class GoogleCalendarApi
{
	public function GetAccessToken($client_id, $redirect_uri, $client_secret, $code) {	
		$url = 'https://accounts.google.com/o/oauth2/token';			
		$curlPost = 'client_id=' . $client_id . '&redirect_uri=' . $redirect_uri . '&client_secret=' . $client_secret . '&code='. $code . '&grant_type=authorization_code';
		$ch = curl_init();		
		curl_setopt($ch, CURLOPT_URL, $url);		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);		
		curl_setopt($ch, CURLOPT_POST, 1);		
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);	
		$data = json_decode(curl_exec($ch), true);
		$http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);		
		if($http_code != 200) {
			throw new Exception('Error : Failed to receieve access token');
		}
		return $data;
	}

	public function GetUserCalendarTimezone($access_token) {
		$url_settings = 'https://www.googleapis.com/calendar/v3/users/me/settings/timezone';
		$ch = curl_init();		
		curl_setopt($ch, CURLOPT_URL, $url_settings);		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);	
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '. $access_token));	
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);	
		$data = json_decode(curl_exec($ch), true); //echo '<pre>';print_r($data);echo '</pre>';
		$http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);		
		if($http_code != 200) {
			throw new Exception('Error : Error al extraer la zona horaria');
		}
		return $data['value'];
	}

	public function GetCalendarsList($access_token) {
		$url_parameters = array();
		$url_parameters['fields'] = 'items(id,summary,timeZone)';
		$url_parameters['minAccessRole'] = 'owner';
		$url_calendars = 'https://www.googleapis.com/calendar/v3/users/me/calendarList?'. http_build_query($url_parameters);
		$ch = curl_init();		
		curl_setopt($ch, CURLOPT_URL, $url_calendars);		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);	
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '. $access_token));	
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);	
		$data = json_decode(curl_exec($ch), true);
		$http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);		
		if($http_code != 200) {
			throw new Exception('Error : Fallo al extraer la lista de calendarios');
		}
		return $data['items'];
	}

	public function CreateCalendarEvent($calendar_id, $summary, $event_time, $event_timezone, $access_token) {
		$url_events = 'https://www.googleapis.com/calendar/v3/calendars/' . $calendar_id . '/events';
		$curlPost = array('summary' => $summary);
		$curlPost['start'] = array('dateTime' => $event_time['start_time'], 'timeZone' => $event_timezone);
		$curlPost['end'] = array('dateTime' => $event_time['end_time'], 'timeZone' => $event_timezone);
		$ch = curl_init();		
		curl_setopt($ch, CURLOPT_URL, $url_events);		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);		
		curl_setopt($ch, CURLOPT_POST, 1);		
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '. $access_token, 'Content-Type: application/json'));	
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($curlPost));	
		$data = json_decode(curl_exec($ch), true);
		$http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);		
		if($http_code != 200) {
			throw new Exception('Error : Fallo al crear el evento');
		}
		return $data['id'];
	}

	public function GetEventsList($calendarId, $dateTime, $access_token) {
		$explodeDate = explode('-', $dateTime['start_time']);
		$explodeTime = explode('T', $explodeDate[2]);
		$url_parameters = array();
		$url_parameters['showDeleted'] = 'false';
		//Format: YYYY-MM-DDTHH:MM:SS.000Z - Example: 2019-07-11T11:23:45.000Z
		$url_parameters['timeMin'] = $explodeDate[0].'-'.$explodeDate[1].'-'.$explodeTime[0].'T01:00:00.000Z';
		$url_parameters['timeMax'] = $explodeDate[0].'-'.$explodeDate[1].'-'.$explodeTime[0].'T23:55:00.000Z';
		$url_events = 'https://www.googleapis.com/calendar/v3/calendars/' . $calendarId . '/events?'. http_build_query($url_parameters);
		$ch = curl_init();		
		curl_setopt($ch, CURLOPT_URL, $url_events);		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);	
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '. $access_token));	
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);		
		$data = json_decode(curl_exec($ch), true);
		$http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);		
		if($http_code != 200) {
			throw new Exception('Error : Error al extraer los eventos');
		}
		return $data['items'];
	}

	public function checkAvailability($calendarId, $dateTime, $access_token) {
		$events = $this->GetEventsList($calendarId, $dateTime, $access_token);
		$availability = true;
		foreach ($events as $event) {
			$bookStartTime = new DateTime($dateTime['start_time'].'+02:00');
			$bookEndTime = new DateTime($dateTime['end_time'].'+02:00');
			$startTime = new DateTime($event['start']['dateTime']);
			$endTime = new DateTime($event['end']['dateTime']);
			if ($bookStartTime < $startTime && $bookEndTime > $startTime && $bookEndTime <= $endTime) {
				$availability = false;
			}elseif ($bookStartTime >= $startTime && $bookEndTime <= $endTime) {
				$availability = false;
			}elseif ($bookStartTime >= $startTime && $bookStartTime < $endTime && $bookEndTime > $endTime) {
				$availability = false;
			}elseif ($bookStartTime < $startTime && $bookEndTime > $endTime) {
				$availability = false;
			}
		}
		return $availability;
	}

}