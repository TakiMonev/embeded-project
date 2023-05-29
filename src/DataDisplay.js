import React from 'react';

const DataDisplay = ({ data }) => {
  return (
    <div>
        <p>{data && JSON.stringify(data.tm)} 기준</p>
        <p>기상청 온도 : {data && JSON.stringify(parseInt(data.ta))}</p>
        <p>기상청 습도 : {data && JSON.stringify(parseInt(data.hm))}</p>
    </div>
  );
};

export default DataDisplay;