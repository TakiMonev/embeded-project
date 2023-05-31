<?php
$config = array(
    "db_host" => "mydb.c4yxzoa8i9pa.ap-northeast-2.rds.amazonaws.com",
    "db_user" => "admin",
    "db_password" => "!Vcd7xkzl1",
    "db_name" => "mydb"
);
?>

<?php

// 데이터베이스 연결 정보
$host = $config['db_host'];
$username = $config['db_user'];
$password = $config['db_password'];
$dbname = $config['db_name'];

// POST 요청 처리
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // 요청 데이터 확인
  $requestData = json_decode(file_get_contents('php://input'), true);

  // 데이터베이스 연결
  $conn = new mysqli($host, $username, $password, $dbname);

  // 연결 오류 확인
  if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
  }

  // 데이터 삽입 SQL 쿼리 작성
  $warnTemperature = $requestData['warn_temp'];
  $dangerTemperature = $requestData['danger_temp'];

  $sql = "INSERT INTO info_tbl (warn_temp, danger_temp) VALUES ('$warnTemperature', '$dangerTemperature')";

  // 데이터 삽입 실행
  if ($conn->query($sql) === TRUE) {
    $response = array(
      'message' => 'Data inserted successfully'
    );
    http_response_code(200);
    echo json_encode($response);
  } else {
    $response = array(
      'message' => 'Failed to insert data'
    );
    http_response_code(500);
    echo json_encode($response);
  }

  // 데이터베이스 연결 종료
  $conn->close();
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
  // 데이터베이스 연결
  $conn = new mysqli($host, $username, $password, $dbname);

  // 연결 오류 확인
  if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
  }

  // 데이터 조회 SQL 쿼리 작성
  $sql = "SELECT * FROM info_tbl";

  // 데이터 조회 실행
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $rows = array();
    while ($row = $result->fetch_assoc()) {
      $rows[] = $row;
    }
    http_response_code(200);
    echo json_encode($rows);
  } else {
    $response = array(
      'message' => 'No data found'
    );
    http_response_code(404);
    echo json_encode($response);
  }

  // 데이터베이스 연결 종료
  $conn->close();
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
  // 요청 데이터 확인
  $requestData = json_decode(file_get_contents('php://input'), true);

  // 데이터베이스 연결
  $conn = new mysqli($host, $username, $password, $dbname);

  // 연결 오류 확인
  if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
  }

  // 수정할 데이터의 ID
  $id = $requestData['id'];

  // 수정할 필드 값
  $warnTemperature = $requestData['warn_temp'];
  $dangerTemperature = $requestData['danger_temp'];

  // 데이터 수정 SQL 쿼리 작성
  $sql = "UPDATE info_tbl SET warn_temp = '$warnTemperature', danger_temp = '$dangerTemperature' WHERE id = $id";

  // 데이터 수정 실행
  if ($conn->query($sql) === TRUE) {
    $response = array(
      'message' => 'Data updated successfully'
    );
    http_response_code(200);
    echo json_encode($response);
  } else {
    $response = array(
      'message' => 'Failed to update data'
    );
    http_response_code(500);
    echo json_encode($response);
  }

  // 데이터베이스 연결 종료
  $conn->close();
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
  // 요청 데이터 확인
  $requestData = json_decode(file_get_contents('php://input'), true);

  // 데이터베이스 연결
  $conn = new mysqli($host, $username, $password, $dbname);

  // 연결 오류 확인
  if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
  }

  // 삭제할 데이터의 ID
  $id = $requestData['id'];

  // 데이터 삭제 SQL 쿼리 작성
  $sql = "DELETE FROM info_tbl WHERE id = $id";

  // 데이터 삭제 실행
  if ($conn->query($sql) === TRUE) {
    $response = array(
      'message' => 'Data deleted successfully'
    );
    http_response_code(200);
    echo json_encode($response);
  } else {
    $response = array(
      'message' => 'Failed to delete data'
    );
    http_response_code(500);
    echo json_encode($response);
  }

  // 데이터베이스 연결 종료
  $conn->close();
} else {
  // 지원하지 않는 요청 메서드일 경우 에러 응답
  http_response_code(405);
  echo json_encode(array('message' => 'Method Not Allowed'));
}

?>