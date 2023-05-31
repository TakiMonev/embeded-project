import React, { useEffect, useRef } from 'react';
import ReactDOM from 'react-dom';

const SetTemp = ({ warnTemperature, setWarnTemperature, dangerTemperature, setDangerTemperature }) => {
  const formRef = useRef(null);

  const handleSubmit = (e) => {
    e.preventDefault();

    const warnTemp = parseFloat(warnTemperature);
    const dangerTemp = parseFloat(dangerTemperature);

    if (isNaN(warnTemp) || isNaN(dangerTemp)) {
      // 숫자로 변환할 수 없는 입력값이 포함된 경우
      console.log('올바른 온도 값을 입력해주세요.');
      return;
    }

    // POST 요청을 보낼 URL
    const url = 'http://ec2-43-200-8-47.ap-northeast-2.compute.amazonaws.com/src/php/crud.php';

    // POST 요청 데이터
    const data = {
      warnTemperature: String(warnTemp),
      dangerTemperature: String(dangerTemp)
    };

    // POST 요청 보내기
    fetch(url, {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(result => {
      // POST 요청에 대한 처리 로직
      console.log(result);
    })
    .catch(error => {
      // POST 요청 실패에 대한 처리 로직
      console.log('Error:', error);
    });
  };

  useEffect(() => {
    const formContainer = formRef.current;
    if (!formContainer) return;

    const formElement = (
      <div>
        <form onSubmit={handleSubmit}>
          <label>
            주의 온도 설정 : &nbsp;
            <input
              type="text"
              value={warnTemperature}
              onChange={(e) => setWarnTemperature(e.target.value)}
            />
            &nbsp;
            <br />
            위험 온도 설정 : &nbsp;
            <input
              type="text"
              value={dangerTemperature}
              onChange={(e) => setDangerTemperature(e.target.value)}
            />
            &nbsp;
            <br />
            <button type="submit">제출</button>
          </label>
        </form>
      </div>
    );

    ReactDOM.render(formElement, formContainer);

    return () => {
      ReactDOM.unmountComponentAtNode(formContainer);
    };
  }, [warnTemperature, setWarnTemperature, dangerTemperature, setDangerTemperature]);

  return (
    <div ref={formRef} id="dynamicForm" />
  );
};

export default SetTemp;