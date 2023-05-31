import React from 'react';

const HardwareDisplay = ({ data }) => {
  return (
    <div>
        <p>{data && JSON.stringify(data.tm)} 기준</p>
        <p>측정 온도 : {data && JSON.stringify(parseInt(data.ta))}</p>
        <p>측정 습도 : {data && JSON.stringify(parseInt(data.hm))}</p>
    </div>
  );
};

export default HardwareDisplay;