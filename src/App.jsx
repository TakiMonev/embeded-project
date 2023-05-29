import React, { useState, useEffect } from 'react';
import DataDisplay from './DataDisplay';
import SetTemp from './SetTemp';

const App = () => {
  const [data, setData] = useState(null);
  const [itemsLength, setItemsLength] = useState(null);
  const [userTemperature, setUserTemperature] = useState('');

  useEffect(() => {
    fetchData();
  }, []);

  const fetchData = async () => {
    try {
      const now = new Date();
      
      const startDt = new Date(now.getTime() - 24 * 60 * 60 * 1000);
      const startDtString = startDt.toISOString().slice(0, 4) + startDt.toISOString().slice(5, 7) + startDt.toISOString().slice(8, 10);
      const startHh = startDt.getHours();

      const endDt = new Date(now.getTime() - 12 * 60 * 60 * 1000);
      const endDtString = endDt.toISOString().slice(0, 4) + endDt.toISOString().slice(5, 7) + endDt.toISOString().slice(8, 10);
      const endHh = endDt.getHours();

      const url = `https://apis.data.go.kr/1360000/AsosHourlyInfoService/getWthrDataList?serviceKey=Ldmc1KxWMK%2FwqUNhCYqM5WKvVhhYLf6Y9eg6jsuMvGDB4mjwOHp63PUkCQFqNFgOY4bX2SRhRyz09Nb37ZQLzw%3D%3D&pageNo=1&numOfRows=13&dataType=JSON&dataCd=ASOS&dateCd=HR&startDt=${startDtString}&startHh=${startHh}&endDt=${endDtString}&endHh=${endHh}&stnIds=131`

      const response = await fetch(url);
      const jsonData = await response.json();
      const body = jsonData.response.body;
      const items = body.items;
      const length = parseInt(items.item.length);
      setItemsLength(length);

      setData(items.item[length - 1]);
    } catch (error) {
      console.error(error);
    }
  };

  return (
    <div>
      <DataDisplay data={data} />
      <div id="dynamicForm">
        <SetTemp
          data={data}
          userTemperature={userTemperature}
          setUserTemperature={setUserTemperature}
        />
      </div>
    </div>
  );
};

export default App;