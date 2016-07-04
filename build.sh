DATE=$(date +"%Y%m%d")
ORG="iais.nm"
PRODUCT="qalabelprototype"

TAG="$ORG/$PRODUCT:$DATE"
TAG_LATEST="$ORG/$PRODUCT:latest"

echo "building image: $TAG"
docker build -f Dockerfile.ubuntu14 -t $TAG .
echo "tagging image: $TAG_LATEST"
docker tag $TAG $TAG_LATEST

docker rm -f $PRODUCT || true
docker run -d --name=$PRODUCT -p 9055:80 $TAG tail -f /dev/null
docker exec qalabelprototype apache2ctl start

sleep 2

docker ps -a | grep $PRODUCT
docker logs $PRODUCT
