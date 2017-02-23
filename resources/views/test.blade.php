<?/*
session_start();
$OAUTH2_CLIENT_ID = '955281492660-bido0e8o6cubevav2eoe4qgfp75vb4k3.apps.googleusercontent.com';
$OAUTH2_CLIENT_SECRET = 'WhaVodO_3NV4dBUKXBB3JzSJ';

$refresh_token = '1/OpezOjAj9eaMyKjauYQQw08K7lXfcjMcXcHvFDPXYUw';
$client = new Google_Client();
$client->setClientId($OAUTH2_CLIENT_ID);
$client->setClientSecret($OAUTH2_CLIENT_SECRET);
$client->setAccessType("offline");        // offline access
$client->setIncludeGrantedScopes(true);   // incremental auth
$client->setScopes('https://www.googleapis.com/auth/youtube');

$redirect = filter_var('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'], FILTER_SANITIZE_URL);
$client->setRedirectUri($redirect);
//$client->revokeToken();

// Define an object that will be used to make all API requests.
$youtube = new Google_Service_YouTube($client);
// Check if an auth token exists for the required scopes
$tokenSessionKey = 'token-' . $client->prepareScopes();

if (isset($refresh_token))
{
    $client->refreshToken($refresh_token);
    $_SESSION[$tokenSessionKey] = $client->getAccessToken();
    header('Location: ' . $redirect);
}
if (isset($_SESSION[$tokenSessionKey]))
{
    $client->setAccessToken($_SESSION[$tokenSessionKey]);
}

$item = 'G4uOf9vWLT0';
        //dd($_SESSION[$tokenSessionKey] );
// Check to ensure that the access token was successfully acquired.
if ($client->getAccessToken()) {
try {
// Call the channels.list method to retrieve information about the
// currently authenticated user's channel.
    $channelsResponse = $youtube->channels->listChannels('contentDetails', array(
        'mine' => 'true',
        ));
    $htmlBody = '';
    foreach ($channelsResponse['items'] as $channel) {
        $uploadsListId = $channel['contentDetails']['relatedPlaylists']['uploads'];
        $playlistItemsResponse = $youtube->playlistItems->listPlaylistItems('snippet', array(
        'playlistId' => $uploadsListId,
        'maxResults' => 50));

        $htmlBody .= "<h3>Videos in list $uploadsListId</h3><ul>";
        foreach ($playlistItemsResponse['items'] as $playlistItem) {
            $htmlBody .= sprintf('<li>%s (%s)</li>', $playlistItem['snippet']['title'],
            $playlistItem['snippet']['resourceId']['videoId']);
            }

        foreach($playlistItemsResponse as $video){
        $htmlBody .= '';
        }
        $htmlBody .= '</ul>'.var_dump($client);
    }


} catch (Google_Service_Exception $e) {
    $htmlBody = sprintf('<p>A service error occurred: <code>%s</code></p>',
    htmlspecialchars($e->getMessage()));
} catch (Google_Exception $e) {
    $htmlBody = sprintf('<p>An client error occurred: <code>%s</code></p>',
    htmlspecialchars($e->getMessage()));
}
$_SESSION[$tokenSessionKey] = $client->getAccessToken();
} elseif ($OAUTH2_CLIENT_ID == '955281492660-bido0e8o6cubevav2eoe4qgfp75vb4k3.apps.googleusercontent.com') {
    $htmlBody = "<h3>Client Credentials Required</h3>
    <p>You need to set <code>\$OAUTH2_CLIENT_ID</code> and <code>\$OAUTH2_CLIENT_ID</code> before proceeding.<p>"; }
    else {
        $state = mt_rand();
        $client->setState($state);
        $_SESSION['state'] = $state;
        $authUrl = $client->createAuthUrl();
        $htmlBody = "<h3>Authorization Required</h3><p>You need to <a href=".$authUrl.">authorize access</a> before proceeding.<p>";
    }
*/?><!--

    <!doctype html>
    <html>
    <head>
        <title>My Uploads</title>
    </head>
    <body>
    <?/*=$htmlBody*/?>
    </body>
    </html>
-->