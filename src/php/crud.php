<?php

// POST 요청 처리
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // 요청 데이터 확인
  $requestData = json_decode(file_get_contents('php://input'), true);

  // 데이터베이스 연결 정보
  $host = 'mydb.c4yxzoa8i9pa.ap-northeast-2.rds.amazonaws.com';
  $username = 'your_username';
  $password = 'your_password';
  $dbname = 'your_database_name';

  // 데이터베이스 연결
  $conn = new mysqli($host, $username, $password, $dbname);

  // 연결 오류 확인
  if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
  }

  // 데이터 삽입 SQL 쿼리 작성
  $warnTemperature = $requestData['warnTemperature'];
  $dangerTemperature = $requestData['dangerTemperature'];
  $sql = "INSERT INTO your_table_name (warn_temperature, danger_temperature) VALUES ('$warnTemperature', '$dangerTemperature')";

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
} else {
  // 지원하지 않는 요청 메서드일 경우 에러 응답
  http_response_code(405);
  echo json_encode(array('message' => 'Method Not Allowed'));
}

?>