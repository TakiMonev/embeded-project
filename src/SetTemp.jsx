import React, { useEffect } from 'react';
import ReactDOM from 'react-dom';

const SetTemp = ({ warnTemperature, setWarnTemperature, dangerTemperature, setDangerTemperature }) => {
  const handleSubmit = (e) => {
    e.preventDefault();
    // 폼 제출 시의 로직을 처리
  };

  useEffect(() => {
    const formContainer = document.getElementById('dynamicForm');
    if (!formContainer) return; // formContainer가 null인 경우 처리

    const formElement = (
      <form onSubmit={handleSubmit}>
        <label>
          특정 온도 설정 : &nbsp;
          <input
            type="text"
            value={warnTemperature}
            onChange={(e) => setWarnTemperature(e.target.value)}
          />
          &nbsp;
          <button type="submit">제출</button>
        </label>

        <br/>

        <label>
          특정 온도 설정 : &nbsp;
          <input
            type="text"
            value={setDangerTemperature}
            onChange={(e) => setDangerTemperature(e.target.value)}
          />
          &nbsp;
          <button type="submit">제출</button>
        </label>
      </form>
    );

    ReactDOM.render(formElement, formContainer);

    return () => {
      ReactDOM.unmountComponentAtNode(formContainer);
    };
  }, [warnTemperature, setWarnTemperature]);

  return null; // 렌더링할 내용이 없으므로 null을 반환합니다.
};

export default SetTemp;